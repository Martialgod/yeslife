<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth; //responsible for our authentication 

use Illuminate\Support\Facades\DB; //responsible for DB

use Exception;

use App\PDOErr;

use App\Country;
use App\State;
use App\StateMstrView;

use App\User;


class StatesController extends Controller
{
    

    public $menu_group = 'states.index';

    public function __construct(){
        $this->middleware(['auth'])->except(['apigetstatebycountry']);
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
        if(!User::isUserHasAccess(7010)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();

        $states = StateMstrView::select();

        $search = ( request()->search ) ? request()->search : null;

        if( $search ){

            $states->where(function ($query) use ($search) {
                $query->where('name', 'like', "%$search%")
                    ->orWhere('code', 'like', "%$search%");
            });

        }

        $states = $states->orderBy('country', 'ASC')->orderBy('name', 'ASC')->paginate(10);

        $sub_menu = User::getSubMenu(Auth::id(), $this->menu_group);
        //dd($sub_menu);
        
        return view('admin.states.index', compact('sub_menu', 'states', 'search'));


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
        if(!User::isUserHasAccess(7011)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();
        $country = Country::getActiveCountry();
        return view('admin.states.create', compact('country'));

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
        if(!User::isUserHasAccess(7011)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();
        //dd($request->all());
        $validator = State::custom_validation($request, 'store');

        if( $validator === true ){

            //begin transaction
            $transaction = DB::transaction(function() use($request) {

                $isexists = State::where('fk_country', $request->fk_country)
                            ->where('name', $request->name)
                            ->first();

                if( $isexists ){
                    return redirect()->back()->withInput()->withErrors(['State in the same country already exists']);
                }

                $request['fk_createdby'] = Auth::id();

                $request['stat'] = 1;
         
                //create will return the newly created object
                $states = State::create($request->all()); //insert all $request

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
        return redirect('/admin/states');

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
        if(!User::isUserHasAccess(7012)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();
        $states = State::findOrFail($id);
        $country = Country::getActiveCountry();
        return view('admin.states.edit', compact('states', 'country'));


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
        if(!User::isUserHasAccess(7012)){
            return redirect('/admin/404');
        }
        
        $this->setActiveTab();
        
        $states = State::findOrFail($id);

        $request['pk_states'] = $states->pk_states;

        $validator = State::custom_validation($request, 'update');

        if( $validator === true ){

            //begin transaction
            $transaction = DB::transaction(function() use($request, $states, $id) {

                $isexists = State::where('fk_country', $request->fk_country)
                            ->where('name', $request->name)
                            ->where('pk_states', '<>', $id)
                            ->first();

                if( $isexists ){
                    return redirect()->back()->withInput()->withErrors(['State in the same country already exists']);
                }

                $request['fk_updatedby'] = Auth::id();
         
                $states->update($request->all());

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
        //
        
        //check if user has access
        if(!User::isUserHasAccess(7013)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();
        
        $states = State::findOrFail($id);

        //catch exception posible for foriegn key constraint
        try{  

            //begin transaction
            $transaction = DB::transaction(function() use($states, $id) {

                $name = $states->name;

                $states->delete(); //delete category

                session()->flash('success', "$name has been deleted!");
                
                return redirect()->back();


            });//END transaction

            return $transaction;

        }catch(Exception $e){
            //dd($e);
            return redirect()->back()->withErrors(PDOErr::checkException($e->errorInfo));

        }//END try


    }//END destroy



    public function apigetstatebycountry($fk_country){

        return State::getStateByCountry($fk_country);

    }


}//END class
