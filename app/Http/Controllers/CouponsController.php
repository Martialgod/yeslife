<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth; //responsible for our authentication 

use Illuminate\Support\Facades\DB; //responsible for DB

use Exception;

use App\PDOErr;

use App\MyHelperClass;

use Carbon\Carbon;

use App\Coupon;

use App\User;



class CouponsController extends Controller
{
    

    public $menu_group = 'coupons.index';

    public function __construct(){
        $this->middleware(['auth'])->except(['apisearchcoupon']);
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
        if(!User::isUserHasAccess(1040)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();

        $coupons = Coupon::select();

        $search = ( request()->search ) ? request()->search : null;

        if( $search ){

            $coupons->where(function ($query) use ($search) {
                $query->where('name', 'like', "%$search%")
                ->orWhere('description', 'like', "%$search%")
                ;
            });

        }

        $coupons = $coupons->orderBy('name', 'ASC')->paginate(10);

        $sub_menu = User::getSubMenu(Auth::id(), $this->menu_group);
        //dd($sub_menu);
        
        return view('admin.coupons.index', compact('sub_menu', 'coupons', 'search'));

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
        if(!User::isUserHasAccess(1041)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();
        return view('admin.coupons.create');
        
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
        if(!User::isUserHasAccess(1041)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();
        //dd($request->all());
        $validator = Coupon::custom_validation($request, 'store');

        if( $validator === true ){

            //begin transaction
            $transaction = DB::transaction(function() use($request) {

                if( $request->effective_at ){
                    //format date to be updated in mysql timestamp
                    $request['effective_at'] = date_format( date_create($request['effective_at']) , 'Y-m-d H:i:00' );
                }
                
                if( $request->expired_at ){
                    //format date to be updated in mysql timestamp
                    $request['expired_at'] = date_format( date_create($request['expired_at']) , 'Y-m-d H:i:00' );
                }

                $request['fk_createdby'] = Auth::id();

                $request['stat'] = 1;
         
                //create will return the newly created object
                $coupons = Coupon::create($request->all()); //insert all $request

                //commented since user is required to manually input coupon code
                //generate random code
                /*$coupons->update([
                    'code'=> MyHelperClass::generateRandomString(4).''.$coupons->pk_coupons
                ]); */

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
        return redirect('/admin/coupons');

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
        if(!User::isUserHasAccess(1042)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();
        $coupons = Coupon::findOrFail($id);
        return view('admin.coupons.edit', compact('coupons'));
    
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
        if(!User::isUserHasAccess(1042)){
            return redirect('/admin/404');
        }
        
        $this->setActiveTab();
        
        $coupons = Coupon::findOrFail($id);

        $request['pk_coupons'] = $coupons->pk_coupons;

        $validator = Coupon::custom_validation($request, 'update');

        if( $validator === true ){

            if( $request->effective_at ){
                //format date to be updated in mysql timestamp
                $request['effective_at'] = date_format( date_create($request['effective_at']) , 'Y-m-d H:i:00' );
            }
            
            if( $request->expired_at ){
                //format date to be updated in mysql timestamp
                $request['expired_at'] = date_format( date_create($request['expired_at']) , 'Y-m-d H:i:00' );
            }

            //dd($request->all());

            $request['fk_updatedby'] = Auth::id();
            
            $coupons->update($request->all());

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
        if(!User::isUserHasAccess(1043)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();
        
        $coupons = Coupon::findOrFail($id);

        //catch exception posible for foriegn key constraint
        try{  

            //begin transaction
            $transaction = DB::transaction(function() use($coupons, $id) {

                $name = $coupons->name;

                $coupons->delete(); //delete category

                session()->flash('success', "$name has been deleted!");
                
                return redirect()->back();


            });//END transaction

            return $transaction;

        }catch(Exception $e){
            //dd($e);
            return redirect()->back()->withErrors(PDOErr::checkException($e->errorInfo));

        }//END try

    }//END destroy



    public function apisearchcoupon(Request $request){

        //return $request->all();

        $userid = ( $request->userid != 'no') ? $request->userid : 0;

        return Coupon::getActiveCoupon($request->couponcode, $userid);

    }//END apisearchcoupon

    


}//END class
