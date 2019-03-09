<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth; //responsible for our authentication 

use Illuminate\Support\Facades\DB; //responsible for DB

use Exception;

use App\PDOErr;

use App\RewardAction;

use App\User;


class RewardActionsController extends Controller
{
    

    public $menu_group = 'actions.index';

    public function __construct(){
        $this->middleware(['auth'])->except([]);
    }

    public function setActiveTab(){
        session()->flash('parent_tab', 'Settings');
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
        if(!User::isUserHasAccess(7020)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();

        $actions = RewardAction::select();

        $search = ( request()->search ) ? request()->search : null;

        if( $search ){

            $states->where(function ($query) use ($search) {
                $query->where('name', 'like', "%$search%");
            });

        }

        $actions = $actions->orderBy('name', 'ASC')->paginate(10);

        $sub_menu = User::getSubMenu(Auth::id(), $this->menu_group);
        //dd($sub_menu);
        
        return view('admin.actions.index', compact('sub_menu', 'actions', 'search'));


    
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
        if(!User::isUserHasAccess(7021)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();
        return view('admin.actions.create');


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
        if(!User::isUserHasAccess(7021)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();
        //dd($request->all());
        $validator = RewardAction::custom_validation($request, 'store');

        if( $validator === true ){

            //begin transaction
            $transaction = DB::transaction(function() use($request) {

                $request['fk_createdby'] = Auth::id();

                $request['stat'] = 1;
         
                //create will return the newly created object
                $actions = RewardAction::create($request->all()); //insert all $request

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
        return redirect('/admin/actions');

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
        if(!User::isUserHasAccess(7022)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();
        $actions = RewardAction::findOrFail($id);
        return view('admin.actions.edit', compact('actions'));


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
        if(!User::isUserHasAccess(7022)){
            return redirect('/admin/404');
        }
        
        $this->setActiveTab();
        
        $actions = RewardAction::findOrFail($id);

        $request['pk_rewardactions'] = $actions->pk_rewardactions;

        $validator = RewardAction::custom_validation($request, 'update');

        if( $validator === true ){

            //begin transaction
            $transaction = DB::transaction(function() use($request, $actions, $id) {


                $request['fk_updatedby'] = Auth::id();
         
                $actions->update($request->all());

                session()->flash('success', "$request->name has been updated!");
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
        //delete action is not supported since primary code needs manual program integration
        return redirect()->back(); 

        //check if user has access
        if(!User::isUserHasAccess(7023)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();
        
        $actions = RewardAction::findOrFail($id);

        //catch exception posible for foriegn key constraint
        try{  

            //begin transaction
            $transaction = DB::transaction(function() use($actions, $id) {

                $name = $actions->name;

                $actions->delete(); //delete category

                session()->flash('success', "$name has been deleted!");
                
                return redirect()->back();


            });//END transaction

            return $transaction;

        }catch(Exception $e){
            //dd($e);
            return redirect()->back()->withErrors(PDOErr::checkException($e->errorInfo));

        }//END try


    }//END destroy


}//END class
