<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth; //responsible for our authentication 

use Illuminate\Support\Facades\DB; //responsible for DB

use App\UserAbandonedCartMstrView;
use App\User;
use App\UserCart;

use Carbon\Carbon;

use Mail;

use App\Mail\BroadCastAbandonedCart;

class AbandonedCartController extends Controller
{
    //
    
    public $menu_group = 'abandonedcart.index';

    public function __construct(){
        $this->middleware(['auth'])->except([]);
    }

    public function setActiveTab(){
        session()->flash('parent_tab', 'Orders');
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
        if(!User::isUserHasAccess(2010)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();

        $abandonedcart = UserAbandonedCartMstrView::select();

        $search = ( request()->search ) ? request()->search : null;

        $notified = ( request()->notified ) ? request()->notified : 'No';

        if( $search ){

            $abandonedcart->where(function ($query) use ($search) {
                $query->where('fullname', 'like', "%$search%");
            });

        }

        if( $notified == 'Yes'){
            $abandonedcart->where('lastnotification', '<>', null);
        }
        elseif( $notified == 'No' ){
            $abandonedcart->where('lastnotification', '=', null);
        }

        $abandonedcart = $abandonedcart->orderBy('lastnotification', 'ASC')->paginate(20);

        $sub_menu = User::getSubMenu(Auth::id(), $this->menu_group);
        //dd($sub_menu);
        
        return view('admin.orders.abandoned-cart', compact('sub_menu', 'abandonedcart', 'search', 'notified'));

    }//END index




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sample_broadcast($id)
    {
        //

        $customers = [
            'email'=> "opic.billsmonitoring@gmail.com",
            'fullname'=> "Jane Doe",
            'userid'=> "1000",
        ];

        $abandonedcart = UserAbandonedCartMstrView::where('fk_users', $customers['userid'])
                            ->first();

        if( !$abandonedcart ){
            return redirect('/admin/404');
        }

        $when = Carbon::now()->addMinutes(1);

        Mail::to($customers['email'], $customers['fullname'])->later($when, new BroadCastAbandonedCart($customers, $abandonedcart));

        //Mail::to($customers['email'], $customers['fullname'])->queue(new BroadCastAbandonedCart($customers, $abandonedcart));

        /*$data = array('customers'=>$customers, 'abandonedcart'=> $abandonedcart);

        $mail = Mail::send('admin.orders.abandoned-cart-template', $data, function($message) use ($customers)
        {   
            $message->from(env('MAIL_USERNAME'), env('MAIL_FROM_NAME'));
            $message->to($customers['email'], $customers['fullname'])
            ->subject('Abandoned Cart!');
        });*/

  
        return view('admin.orders.abandoned-cart-template', compact('abandonedcart', 'customers'));
 
    }//END sample_broadcast





    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_broadcast(Request $request)
    {
        //
        //return $request->all();
        //no checking of access. store_broadcast will only be triggerd in ajax request
        
        //begin transaction
        $transaction = DB::transaction(function() use($request) {

            $customers = $request->customers;

            $abandonedcart = UserAbandonedCartMstrView::where('fk_users', $customers['userid'])->first();


            $when = Carbon::now()->addMinutes(1);

            Mail::to($customers['email'], $customers['fullname'])->later($when, new BroadCastAbandonedCart($customers, $abandonedcart));


            //Mail::to($customers['email'], $customers['fullname'])->queue(new BroadCastAbandonedCart($customers, $abandonedcart));

            /*$data = array('customers'=>$customers, 'abandonedcart'=> $abandonedcart);

            $mail = Mail::send('admin.orders.abandoned-cart-template', $data, function($message) use ($customers)
            {   
                $message->from(env('MAIL_USERNAME'), env('MAIL_FROM_NAME'));
                $message->to($customers['email'], $customers['fullname'])
                ->subject('Abandoned Cart!');
            });*/

            $fk_notifiedby = Auth::id();

            //update notification date for the cart
            $cart = UserCart::where('fk_users', $customers['userid'])
                ->update([
                    'notified_at'=> Carbon::now(),
                    'fk_notifiedby'=> $fk_notifiedby
                ]);


            return $cart;

        });//END transaction

        return $transaction;

       
    
    }//END store_broadcast



}//END class
