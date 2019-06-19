<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth; //responsible for our authentication 

use Illuminate\Support\Facades\DB; //responsible for DB

use Exception;

use App\PDOErr;

use Carbon\Carbon;

use App\Faq;

use App\GlobalMessage;

use App\User;


class FaqsController extends Controller
{
    //
    
    public $menu_group = 'faqs.index';

    public function __construct(){
        $this->middleware(['auth'])->except([]);
    }

    public function setActiveTab(){
        session()->flash('parent_tab', 'Posts');
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
        if(!User::isUserHasAccess(7040)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();

        $faqs = Faq::select();

        $search = ( request()->search ) ? request()->search : null;

        if( $search ){

            $faqs->where(function ($query) use ($search) {
                $query->where('question', 'like', "%$search%");
            });

        }

        $faqs = $faqs->orderBy('indexno', 'ASC')->paginate(10);

        $sub_menu = User::getSubMenu(Auth::id(), $this->menu_group);
        //dd($sub_menu);
        
        $globalmessage = GlobalMessage::findOrFail(3000);


        return view('admin.faqs.index', compact('sub_menu', 'faqs', 'search', 'globalmessage'));

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
        if(!User::isUserHasAccess(7041)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();
		
		$maxindexno = DB::select("SELECT coalesce(max(indexno),0)+1 as indexno
            FROM faqs;
        ");
        $maxindexno = (count($maxindexno ) > 0) ? $maxindexno[0]->indexno : 0;

        return view('admin.faqs.create', compact('maxindexno'));

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
        if(!User::isUserHasAccess(7041)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();
        //dd($request->all());
        $validator = Faq::custom_validation($request, 'store');

        if( $validator === true ){

            //begin transaction
            $transaction = DB::transaction(function() use($request) {

                $request['fk_createdby'] = Auth::id();

                $request['stat'] = 1;
         
                //create will return the newly created object
                $faqs = Faq::create($request->all()); //insert all $request

                session()->flash('success', "$request->question has been created!");
                return redirect()->back();



            });//END transaction

            return $transaction;

          
        }
        else{

            return redirect()->back()->withInput()->withErrors($validator);
        }

    }//END store




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
        if(!User::isUserHasAccess(7042)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();
        $faqs = Faq::findOrFail($id);
        return view('admin.faqs.edit', compact('faqs'));
    
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
        if(!User::isUserHasAccess(7042)){
            return redirect('/admin/404');
        }
        
        $this->setActiveTab();
        
        $faqs = Faq::findOrFail($id);

        $request['pk_faqs'] = $faqs->pk_faqs;

        $validator = Faq::custom_validation($request, 'update');

        if( $validator === true ){

            $request['fk_updatedby'] = Auth::id();
            $faqs->update($request->all());

            session()->flash('success', "$request->question has been updated!");
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
        if(!User::isUserHasAccess(7043)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();
        
        $faqs = Faq::findOrFail($id);

        //catch exception posible for foriegn key constraint
        try{  

            //begin transaction
            $transaction = DB::transaction(function() use($faqs, $id) {

                $question = $faqs->question;

                $faqs->delete(); //delete category

                session()->flash('success', "$question has been deleted!");
                
                return redirect()->back();


            });//END transaction

            return $transaction;

        }catch(Exception $e){
            //dd($e);
            return redirect()->back()->withErrors(PDOErr::checkException($e->errorInfo));

        }//END try
   
    }//END destroy


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateReferences(Request $request, $id)
    {
        //
        //check if user has access
        if(!User::isUserHasAccess(7040)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();
    
        //dd($request->all());
        
        $globalmessage = GlobalMessage::findOrFail($id);

        //begin transaction
        $transaction = DB::transaction(function() use($request, $globalmessage) {

            $request['fk_updatedby'] = Auth::id();

            $globalmessage->update($request->all());

            session()->flash('success', "record has been updated!");
            return redirect()->back();


        });//END transaction

        return $transaction;


    }//END updateReferences


    


    
}//END class
