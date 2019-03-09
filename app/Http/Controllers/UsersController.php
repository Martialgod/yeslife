<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth; //responsible for our authentication 

use Illuminate\Support\Facades\DB; //responsible for DB

use Hash;

use Exception;

use App\PDOErr;

use App\MyHelperClass;

use Carbon\Carbon;

use App\User;
use App\UserType;

use App\UserMstrView;
use App\UserDownlineView;

use App\Country;
use App\State;


class UsersController extends Controller
{
    
    protected $primaryKey = 1000; //primary key of super admin

    public $menu_group = 'users.index';

    public function __construct(){
        $this->middleware(['auth'])->except(['apisearchusers']);
        //$this->middleware(['issuperadmin'])->except(['profile', 'updateprofile']);
    }


    public function setActiveTab(){
        session()->flash('parent_tab', 'Users');
        session()->flash('child_tab', $this->menu_group);
    }


    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if( request()->ajax() ){
            return 'ajax';
        }

        //check if user has access
        if(!User::isUserHasAccess(5001)){
            return redirect('/admin/404');
        }


        $this->setActiveTab();

        $users = UserMstrView::select();

        $search = ( request()->search ) ? request()->search : null;

        if( $search ){


            $users->where(function ($query) use ($search) {
                $query->where('fullname', 'like', "%$search%")
                    ->orWhere('uname', 'like', "%$search%")
                    ->orWhere('utype', 'like', "%$search%");
            });


        }

        //do not include super admin account
        $users->where('id', '<>', '1000'); 

        $users = $users->orderBy('fullname', 'ASC')->paginate(10);

        $sub_menu = User::getSubMenu(Auth::id(), $this->menu_group);
        //dd($sub_menu);

        return view('admin.users.index', compact('sub_menu', 'users', 'search'));

    }//END index


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //check if user has access
        if(!User::isUserHasAccess(5002)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();
        $usertype = UserType::getActiveUserType();
        $country = Country::getActiveCountry();
        $states = State::getStateByCountry(229); //USA
        return view('admin.users.create', compact('usertype', 'country', 'states'));
    
    }//END create


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //check if user has access
        if(!User::isUserHasAccess(5002)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();
        //dd($request->all());
        $validator = User::custom_validation($request, 'store');

        if( $validator === true ){


            //begin transaction
            $transaction = DB::transaction(function() use($request) {

                
                $request['password'] = bcrypt($request->password);
                $request['fullname'] = $request->fname.' '.$request->lname;
                $request['fk_createdby'] = Auth::id();
                $request['fk_updatedby'] = Auth::id();
                $request['stat'] = 1;  //default stat
               
                $users = User::create($request->all()); //insert all $request

                $users->update([
                    'affiliate_token'=> MyHelperClass::generateRandomString(10).''.$users->id
                ]);
                
                session()->flash('success', "$request->fullname has been created!");
                //return redirect()->route('users.create');
                return redirect()->back();



            });//END transaction

            return $transaction;


        }
        else{

            //return redirect()->route('users.create')->withInput()->withErrors($validator);
            return redirect()->back()->withInput()->withErrors($validator);

        }

        //dd($request->all());
    
    }//END store


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return redirect('/admin/users');
    
    }//END show



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        //check if user has access
        if(!User::isUserHasAccess(5003)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();
        $users = User::findOrFail($id);
        $usertype = UserType::getActiveUserType();
        $country = Country::getActiveCountry();
        $states = State::getStateByCountry($users->fk_country);
        $iscustomstate = State::isCustomState($users->state);
        //return $iscustomstate;
        return view('admin.users.edit', compact('users', 'usertype', 'country', 'states', 'iscustomstate'));
    
    }//END edit


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        //dd($request->all());
        
        //check if user has access
        if(!User::isUserHasAccess(5003)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();
        $users = User::findOrFail($id);

        $request['id'] = $id; //check for duplicate entry

        $validator = User::custom_validation($request, 'update');

        //dd($request->all());

        if( $validator === true ){

            //dd($request->all());

            //begin transaction
            $transaction = DB::transaction(function() use($request, $users) {

                $newpword = $request->password; //temporary storage for empty password checking
                $oldpword = $users->password; //retrieve old password for security
                
                $request['fullname'] = $request->fname.' '.$request->lname;
                $request['fk_updated'] = Auth::id();
                $request['password'] = bcrypt($request->password); //might contain empty password

                $users->update($request->all()); //mass update. empty password will still be updated

                //check if new password is empty. rollback password
                if( !$newpword  ){
                    $users->update(['password'=> $oldpword ]);
                }


                session()->flash('success', "$request->fullname has been updated!");
                return redirect()->back();



            });//END transaction

            return $transaction;

           
        }
        else{

            return redirect()->back()->withInput()->withErrors($validator);
        }

    }//END update



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        
        //check if user has access
        if(!User::isUserHasAccess(5004)){
            return redirect('/admin/404');
        }
        
        $this->setActiveTab();

        //$id = 1000;
        //do not display super admin account to avoid data modification
        $users = User::where('id', '=', $id)->where('id', '<>', $this->primaryKey)->first();

        //return $users;


        if($users){

            //catch exception posible for foriegn key constraint
            try{  

                //begin transaction
                $transaction = DB::transaction(function() use($users, $id) {

                    
                    $description = $users->fullname;

                    $users->delete();
                    
                    session()->flash('success', "$description has been deleted!");
                    return redirect()->back();


                });//END transaction

                return $transaction;

            }catch(Exception $e){
                //dd($e);
                return redirect()->back()->withErrors(PDOErr::checkException($e->errorInfo));

            }//END try

        }   
        else{

            session()->flash('error', "Code $id is not found!");
            return redirect()->back();
 
        }
         
    }//END destroy



    /**
     * Show the specified resource from storage.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        //
        session()->flash('parent_tab', '');
        session()->flash('child_tab', '');
        $users = User::findOrFail(Auth::id());
        $country = Country::getActiveCountry();
        $states = State::getStateByCountry($users->fk_country);
        $iscustomstate = State::isCustomState($users->state);
        return view('admin.profile', compact('users', 'country', 'states', 'iscustomstate'));
    
    }//END profile



    /**
     * Update the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateprofile(Request $request)
    {
        //

        session()->flash('parent_tab', '');
        session()->flash('child_tab', '');

        $users = User::findOrFail(Auth::id());

        //check for current password
        if (!Hash::check($request->currentpw, $users->password))
        {
            session()->flash('error', "invalid current password");
            return redirect()->back()->withInput();
        }

        $request['fk_usertype'] = $users->fk_usertype; //avoid validation error

        $validator = User::custom_validation($request, 'profile');

        //dd($request->all());

        //check if $validator is true && record is found
        if( $validator === true ){

            //begin transaction
            $transaction = DB::transaction(function() use($request, $users) {

                $newpword = $request->password; //temporary storage for empty password checking
                $oldpword = $users->password; //retrieve old password for security
                
                $request['fullname'] = $request->fname.' '.$request->lname;
                $request['fk_updated'] = Auth::id();
                $request['password'] = bcrypt($request->password); //might contain empty password

                $users->update($request->all()); //mass update. empty password will still be updated

                //check if new password is empty. rollback password
                if( !$newpword  ){
                    $users->update(['password'=> $oldpword ]);
                }

                session()->flash('success', "your profile has been updated!");
                return redirect()->back();


            });//END transaction

            return $transaction;


        }
        else{

            //set password to null
            if( $users ){
                $users->password = null;
            }

            return redirect()->back()->withInput()->withErrors($validator);


        }

        //dd($request->all());


    }//END updateprofile



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function downline($id)
    {
        //

        //check if user has access
        if(!User::isUserHasAccess(5005)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();
        $users = User::findOrFail($id);
        
        $downline = UserDownlineView::select();

        $downline = $downline->where('fk_referredby', $id)->get();

        return view('admin.users.downline', compact('users', 'downline'));


    }//END affiliate


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function apisearchusers()
    {
        //
        if( !request()->ajax() ){
            return '';
        }

        $users = UserMstrView::select();

        $search = ( request()->search ) ? request()->search : null;

        if( $search ){

            $users->where(function ($query) use ($search) {
                $query->where('fullname', 'like', "%$search%");
            });


        }

        //do not include super admin account
        $users->where('id', '<>', '1000'); 

        $users = $users->orderBy('fullname', 'ASC')->paginate(20);

        return response()->json($users, 200);

    }//END apisearchusers



}//END class
