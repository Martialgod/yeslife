<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth; //responsible for our authentication 

use Illuminate\Support\Facades\DB; //responsible for DB

use Illuminate\Support\Facades\Storage; //responsible for filesystems

use Exception;

use App\PDOErr;

use Carbon\Carbon;

use App\Certification;
use App\CertificationDtl;

use App\CertificationMstrView;

use App\Product;
use App\ProductGroup;

use App\GlobalMessage;

use App\User;

use App\AppStorage;


class CertificationsController extends Controller
{
    //
    
	public $menu_group = 'certifications.index';

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
        if(!User::isUserHasAccess(3010)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();

        $certifications = CertificationMstrView::select();

        $search = ( request()->search ) ? request()->search : null;

        if( $search ){

            $certifications->where(function ($query) use ($search) {
                $query->where('productname', 'like', "%$search%");
            });

        }

        $certifications = $certifications->orderBy('productname', 'DESC')->paginate(10);

        $sub_menu = User::getSubMenu(Auth::id(), $this->menu_group);
        //dd($sub_menu);
        
        $globalmessage = GlobalMessage::findOrFail(2000);

        return view('admin.certifications.index', compact('sub_menu', 'certifications', 'search', 'globalmessage'));

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
        if(!User::isUserHasAccess(3011)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();

        $products = Product::where('stat', 1)
        			->where('fk_productgroup', '<>', '1')
        			->orderBy('fk_productgroup', 'ASC')
        			->orderBy('indexno', 'ASC')
        			->get();

        return view('admin.certifications.create', compact('products'));

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
        if(!User::isUserHasAccess(3011)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();
        //dd($request->all());

        $validator = CertificationDtl::custom_validation($request, 'store');

        if( $validator === true ){

	        //begin transaction
	        $transaction = DB::transaction(function() use($request) {

	        	$request['fk_products'] = ( $request->fk_products != '-1' ) ? $request->fk_products : null;

	        	//dd($request->all());

	            $request['fk_createdby'] = Auth::id();

	            $request['stat'] = 1;

	    	  	$certmstr = Certification::where('fk_products', $request->fk_products)->first();

	    	  
	            if( !$certmstr ){

	            	// insert mstr
	            	$certmstr = Certification::create($request->all());

	            }



	            //insert details
	            $request['fk_certificatemstr'] = $certmstr->pk_certificatemstr;
	            $certdtls = CertificationDtl::create($request->all());
	            
	            //if request uploaded picture
                if( $request->pictx ){

                    //update DB for correct filename @pictx
                   	$certdtls->update([
                        'pictx'=> AppStorage::store('certifications', $request->pictx)
                    ]);

                }//END check if request uploaded picture

	            session()->flash('success', "new certification has been created!");

	            return redirect()->back();



	        });//END transaction

        	return $transaction;

        }else{

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
        return redirect('/admin/certifications');
   
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
        if(!User::isUserHasAccess(3012)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();
        $certifications = Certification::findOrFail($id);

       	$products = Product::where('stat', 1)
    			->where('fk_productgroup', '<>', '1')
    			->orderBy('fk_productgroup', 'ASC')
    			->orderBy('indexno', 'ASC')
    			->get();

    	$gallery = CertificationDtl::where('fk_certificatemstr', $id)->get();

        return view('admin.certifications.edit', compact('certifications', 'gallery', 'products'));

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
        if(!User::isUserHasAccess(3012)){
            return redirect('/admin/404');
        }
        
        $this->setActiveTab();
    
        //dd($request->all());
        
        $certifications = Certification::findOrFail($id);

        //begin transaction
        $transaction = DB::transaction(function() use($request, $certifications) {

    		$request['fk_products'] = ( $request->fk_products != '-1' ) ? $request->fk_products : null;

            $request['fk_updatedby'] = Auth::id();

        	$certifications->update($request->all());
            
            //remove gallery
            if( $request->removegallery ){

                foreach($request->removegallery as $key => $v){
                    
                    CertificationDtl::where('pictx', $key)->delete();
                    AppStorage::remove($key);

                }

            }//END remove gallery


            
            session()->flash('success', "record has been updated!");
            return redirect()->back();


        });//END transaction

        return $transaction;

          
  
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
        if(!User::isUserHasAccess(3014)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();
        
        $certmstr = Certification::findOrFail($id);

        //catch exception posible for foriegn key constraint
        try{  

            //begin transaction
            $transaction = DB::transaction(function() use($certmstr, $id) {

            	$gallery = CertificationDtl::where('fk_certificatemstr', $id)->get();
                CertificationDtl::where('fk_certificatemstr', $id)->delete();

                $certmstr->delete(); //delete certifications

                //delete gallery on the last part of the transaction
                //this will prevent accidental deletion when transaction fails
                foreach($gallery as $key => $v){
                    AppStorage::remove($v->pictx);
                }

                session()->flash('success', "record has been deleted!");
                
                return redirect()->back();


            });//END transaction

            return $transaction;

        }catch(Exception $e){
            //dd($e);
            return redirect()->back()->withErrors(PDOErr::checkException($e->errorInfo));

        }//END try
        
    }//END destroy



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_main_content(Request $request, $id)
    {
        //
        //check if user has access
        if(!User::isUserHasAccess(3010)){
            return redirect('/admin/404');
        }
        
        $this->setActiveTab();
    
        //dd($request->all());
        
        $globalmessage = GlobalMessage::findOrFail($id);

        //begin transaction
        $transaction = DB::transaction(function() use($request, $globalmessage) {

            $request['fk_updatedby'] = Auth::id();

            $globalmessage->update($request->all());
            
            //remove gallery

            session()->flash('success', "record has been updated!");
            return redirect()->back();


        });//END transaction

        return $transaction;

          
  
    }//END update_main_content




}//END class
