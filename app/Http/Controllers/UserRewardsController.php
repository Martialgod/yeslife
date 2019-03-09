<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth; //responsible for our authentication 

use Illuminate\Support\Facades\DB; //responsible for DB

use Exception;

use App\PDOErr;

use App\User;

use App\UserReward;
use App\UserRewardMstrView;

use App\RewardAction;

class UserRewardsController extends Controller
{
    
    public $menu_group = 'rewards.index';

    public function __construct(){
        $this->middleware(['auth'])->except([]);
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
        if(!User::isUserHasAccess(5020)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();

        $rewards = UserRewardMstrView::select();

        $search = ( request()->search ) ? request()->search : null;

        $fk_users = ( request()->fk_users ) ? request()->fk_users : '-1'; //all

        $actionname = ( request()->actionname ) ? request()->actionname : 'All'; //all
       
        if( $search ){

            $rewards->where(function ($query) use ($search) {
                $query->where('fullname', 'like', "%$search%");
            });

        }

        if( $fk_users != '-1' ){
            $rewards->where('fk_users', $fk_users);
        }

        if( $actionname != 'All' ){
            $rewards->where('actionname', '=', $actionname);
        }


        $fullname = User::fullname($fk_users); //for select2 default value

        $rewards = $rewards->orderBy('fullname', 'ASC')->paginate(10);

        $sub_menu = User::getSubMenu(Auth::id(), $this->menu_group);
        //dd($sub_menu);
        
        $mscrewardactions = RewardAction::all();
        
        return view('admin.rewards.index', compact('sub_menu', 'rewards', 'actionname', 'mscrewardactions', 'search', 'fk_users', 'fullname'));

        
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
        if(!User::isUserHasAccess(5021)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();
        $actions = RewardAction::getManualAction();
        return view('admin.rewards.create', compact('actions'));

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
        if(!User::isUserHasAccess(5021)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();
        //dd($request->all());
        $validator = UserReward::custom_validation($request, 'store');

        if( $validator === true ){

            //begin transaction
            $transaction = DB::transaction(function() use($request) {

                $request['fk_createdby'] = Auth::id();

                $request['stat'] = 1;
         
                //create will return the newly created object
                $rewards = UserReward::create($request->all()); //insert all $request

                session()->flash('success', "manual reward has been created!");
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
        return redirect('/admin/rewards');

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
        if(!User::isUserHasAccess(5022)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();
        $rewards = UserRewardMstrView::findOrFail($id);
        $actions = RewardAction::getManualAction();
        return view('admin.rewards.edit', compact('rewards', 'actions'));

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
        if(!User::isUserHasAccess(5022)){
            return redirect('/admin/404');
        }
        
        $this->setActiveTab();
        
        $rewards = UserReward::findOrFail($id);

        $request['pk_userrewards'] = $rewards->pk_userrewards;

        $validator = UserReward::custom_validation($request, 'update');

        if( $validator === true ){

            //begin transaction
            $transaction = DB::transaction(function() use($request, $rewards, $id) {

                $request['fk_updatedby'] = Auth::id();
         
                $rewards->update($request->all());

                session()->flash('success', "manual reward has been updated!");
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
        return redirect('/admin/rewards');

    }//END destroy


}//END class
