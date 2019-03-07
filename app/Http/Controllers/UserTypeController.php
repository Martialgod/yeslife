<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth; //responsible for our authentication 

use Illuminate\Support\Facades\DB; //responsible for DB

use Exception;

use App\PDOErr;

use Carbon\Carbon;

use App\UserType;
use App\UserTypeModule;

use App\User;

class UserTypeController extends Controller
{
    
    public $menu_group = 'usertype.index';

    public function __construct(){
        $this->middleware(['auth'])->except(['api_show_modules']);
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
        
        //check if user has access
        if(!User::isUserHasAccess(5010)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();

        $usertype = UserType::select();

        $search = ( request()->search ) ? request()->search : null;

        if( $search ){

            $usertype->where(function ($query) use ($search) {
                $query->where('name', 'like', "%$search%")
                ->orWhere('description', 'like', "%$search%");
            });

        }

        $usertype = $usertype->orderBy('name', 'ASC')->paginate(10);

        $sub_menu = User::getSubMenu(Auth::id(), $this->menu_group);
        //dd($sub_menu);

        return view('admin.usertype.index', compact('sub_menu', 'usertype', 'search'));

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
        if(!User::isUserHasAccess(5011)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();
        return view('admin.usertype.create');
    
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
        if(!User::isUserHasAccess(5011)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();
        //dd($request->all());
        $validator = UserType::custom_validation($request, 'store');

        if( $validator === true ){

            //begin transaction
            $transaction = DB::transaction(function() use($request) {

                $request['fk_createdby'] = Auth::id();

                $request['stat'] = 1;
         
                //create will return the newly created object
                $usertype = UserType::create($request->all()); //insert all $request

                //insert default module. Dashboard / Home
                UserTypeModule::create([
                    'fk_usertype'=>  $usertype->pk_usertype,
                    'fk_permalink'=> 1000,
                    'fk_createdby'=> $request['fk_createdby'],
                    'fk_updatedby'=> $request['fk_createdby']
                ]);

                session()->flash('success', "$request->name has been created!");
                return redirect()->back();



            });//END transaction

            return $transaction;

          
        }
        else{

            return redirect()->back()->withInput()->withErrors($validator);
        }


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
        return redirect('/admin/usertype');
    
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
        if(!User::isUserHasAccess(5012)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();
        $usertype = UserType::findOrFail($id);
        return view('admin.usertype.edit', compact('usertype'));
    
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
        //check if user has access
        if(!User::isUserHasAccess(5012)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();
        
        $usertype = UserType::findOrFail($id);

        $request['pk_usertype'] = $usertype->pk_usertype;

        $validator = UserType::custom_validation($request, 'update');

        if( $validator === true ){

            $request['fk_updatedby'] = Auth::id();

            $usertype->update($request->all());

            session()->flash('success', "$request->name has been updated!");
            return redirect()->back();


          
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
        if(!User::isUserHasAccess(5013)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();
        
        $usertype = UserType::findOrFail($id);

        //catch exception posible for foriegn key constraint
        try{  

            //begin transaction
            $transaction = DB::transaction(function() use($usertype, $id) {

                $name = $usertype->name;

                UserTypeModule::where('fk_usertype', $id)->delete();

                $usertype->delete(); //delete category

                session()->flash('success', "$name has been deleted!");
                
                return redirect()->back();


            });//END transaction

            return $transaction;

        }catch(Exception $e){
            //dd($e);
            return redirect()->back()->withErrors(PDOErr::checkException($e->errorInfo));

        }//END try

    }//END destroy



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show_modules($id)
    {
        //
        //dd(request()->cookie());

        if( request()->ajax() ){

            $A = DB::select("call usp_getModules($id, 'A')");
            $B = DB::select("call usp_getModules($id, 'B')");
            $C = DB::select("call usp_getModules($id, 'C')");

            return ['A'=>$A, 'B'=>$B, 'C'=>$C,];

        }   

        //check if user has access
        if(!User::isUserHasAccess(5014)){
            return redirect('/admin/404');
        }
 
        $this->setActiveTab();
        $usertype = UserType::findOrFail($id);
        return view('admin.usertype.modules', compact('usertype'));
    
    }//END show_modules


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_modules(Request $request, $id)
    {
        //
        //return $request->all();

        if( request()->ajax() ){

            //begin transaction
            $transaction = DB::transaction(function() use($request, $id) {

                $fk_createdby = Auth::id();
                $fk_updatedby = Auth::id(); 

                //remove current module
                UserTypeModule::where('fk_usertype', '=', $id)->delete();

                //loop selected modules to be inserted to useraccess table
                foreach ($request->modules as $key => $v) {

                   UserTypeModule::create([
                        'fk_usertype'=> $id,
                        'fk_permalink'=> $v['pk_permalink'],
                        'fk_createdby'=> $fk_createdby,
                        'fk_updatedby'=> $fk_updatedby
                    ]);
                }

             
                //all query are successful
                return 'success'; 

            });//END transaction

            return $transaction;


        }  

    }//END update_modules




}//END class
