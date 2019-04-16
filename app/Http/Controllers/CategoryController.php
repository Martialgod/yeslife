<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth; //responsible for our authentication 

use Illuminate\Support\Facades\DB; //responsible for DB

use Exception;

use App\PDOErr;

use Carbon\Carbon;

use App\Category;

use App\User;


class CategoryController extends Controller
{
    
    public $menu_group = 'category.index';

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
        if(!User::isUserHasAccess(1030)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();

        $category = Category::select();

        $search = ( request()->search ) ? request()->search : null;

        if( $search ){

            $category->where(function ($query) use ($search) {
                $query->where('description', 'like', "%$search%");
            });

        }

        $category = $category->orderBy('indexno', 'ASC')->orderBy('description', 'DESC')->paginate(10);

        $sub_menu = User::getSubMenu(Auth::id(), $this->menu_group);
        //dd($sub_menu);
        
        return view('admin.category.index', compact('sub_menu', 'category', 'search'));

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
        if(!User::isUserHasAccess(1031)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();

        $maxindexno = DB::select("SELECT coalesce(max(indexno),0)+1 as indexno
                    FROM category;
                ");
        $maxindexno = (count($maxindexno ) > 0) ? $maxindexno[0]->indexno : 0;
        return view('admin.category.create', compact('maxindexno'));

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
        if(!User::isUserHasAccess(1031)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();
        //dd($request->all());
        $validator = Category::custom_validation($request, 'store');

        if( $validator === true ){

            //begin transaction
            $transaction = DB::transaction(function() use($request) {

                $request['fk_createdby'] = Auth::id();

                $request['stat'] = 1;
         
                //create will return the newly created object
                $category = Category::create($request->all()); //insert all $request

                session()->flash('success', "$request->description has been created!");
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
        return redirect('/admin/category');
   
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
        if(!User::isUserHasAccess(1032)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

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
        if(!User::isUserHasAccess(1032)){
            return redirect('/admin/404');
        }
        
        $this->setActiveTab();
        
        $category = Category::findOrFail($id);

        $request['pk_category'] = $category->pk_category;

        $validator = Category::custom_validation($request, 'update');

        if( $validator === true ){

            $request['fk_updatedby'] = Auth::id();
            $category->update($request->all());

            session()->flash('success', "$request->description has been updated!");
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
        if(!User::isUserHasAccess(1033)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();
        
        $category = Category::findOrFail($id);

        //catch exception posible for foriegn key constraint
        try{  

            //begin transaction
            $transaction = DB::transaction(function() use($category, $id) {

                $description = $category->description;

                $category->delete(); //delete category

                session()->flash('success', "$description has been deleted!");
                
                return redirect()->back();


            });//END transaction

            return $transaction;

        }catch(Exception $e){
            //dd($e);
            return redirect()->back()->withErrors(PDOErr::checkException($e->errorInfo));

        }//END try

    }//END destroy


}//END class
