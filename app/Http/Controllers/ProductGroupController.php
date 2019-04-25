<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth; //responsible for our authentication 

use Illuminate\Support\Facades\DB; //responsible for DB

use Exception;

use App\PDOErr;

use Carbon\Carbon;

use App\ProductGroup;

use App\User;

class ProductGroupController extends Controller
{
    //
    

    public $menu_group = 'productgroup.index';

    public function __construct(){
        $this->middleware(['auth'])->except([]);
    }

    public function setActiveTab(){
        session()->flash('parent_tab', 'Products');
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
        if(!User::isUserHasAccess(1060)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();

        $productgroup = ProductGroup::select();

        $search = ( request()->search ) ? request()->search : null;

        if( $search ){

            $productgroup->where(function ($query) use ($search) {
                $query->where('name', 'like', "%$search%");
            });

        }

        $productgroup = $productgroup->orderBy('name', 'DESC')->paginate(10);

        $sub_menu = User::getSubMenu(Auth::id(), $this->menu_group);
        //dd($sub_menu);
        
        return view('admin.productgroup.index', compact('sub_menu', 'productgroup', 'search'));

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
        if(!User::isUserHasAccess(1061)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();

        return view('admin.productgroup.create');

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
        if(!User::isUserHasAccess(1061)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();
        //dd($request->all());
        $validator = ProductGroup::custom_validation($request, 'store');

        if( $validator === true ){

            //begin transaction
            $transaction = DB::transaction(function() use($request) {

                $request['fk_createdby'] = Auth::id();

                $request['stat'] = 1;
         
                //create will return the newly created object
                $productgroup = ProductGroup::create($request->all()); //insert all $request

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
        return redirect('/admin/productgroup');
   
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
        if(!User::isUserHasAccess(1062)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();
        $productgroup = ProductGroup::findOrFail($id);
        return view('admin.productgroup.edit', compact('productgroup'));
    
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
       
        //check if user has access
        if(!User::isUserHasAccess(1062)){
            return redirect('/admin/404');
        }
        
        $this->setActiveTab();
        
        $productgroup = ProductGroup::findOrFail($id);

        $request['pk_productgroup'] = $productgroup->pk_productgroup;

        $validator = ProductGroup::custom_validation($request, 'update');

        if( $validator === true ){

            $request['fk_updatedby'] = Auth::id();
            $productgroup->update($request->all());

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
        if(!User::isUserHasAccess(1063)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();
        
        $productgroup = ProductGroup::findOrFail($id);

        //catch exception posible for foriegn key constraint
        try{  

            //begin transaction
            $transaction = DB::transaction(function() use($productgroup, $id) {

                $name = $productgroup->name;

                $productgroup->delete(); //delete category

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
