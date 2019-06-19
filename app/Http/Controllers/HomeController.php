<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth; //responsible for our authentication 

use Illuminate\Support\Facades\DB; //responsible for DB

use App\User;

use App\GlobalMessage;

use Carbon\Carbon;


class HomeController extends Controller
{
    
    public function __construct(){
        $this->middleware(['auth'])->except([]);
    }


    public function setActiveTab(){
        session()->flash('parent_tab', 'Home');
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
        if(!User::isUserHasAccess(1000)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();

        return view('admin.index');
   
    }//END index


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function privacyindex()
    {
        //
        //check if user has access
        if(!User::isUserHasAccess(7050)){
            return redirect('/admin/404');
        }

        $globalmessage = GlobalMessage::findOrFail(4000);

        session()->flash('parent_tab', 'Posts');
        session()->flash('child_tab', 'privacy.index');

        return view('admin.globalmessage.privacy-policy', compact('globalmessage'));
   
    }//END privacyindex


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function privacyupdate(Request $request, $id)
    {
        //
        //check if user has access
        if(!User::isUserHasAccess(7050)){
            return redirect('/admin/404');
        }
        
        $globalmessage = GlobalMessage::findOrFail($id);

        //begin transaction
        $transaction = DB::transaction(function() use($request, $globalmessage) {

            $request['fk_updatedby'] = Auth::id();

            $globalmessage->update($request->all());

            session()->flash('success', "record has been updated!");
            return redirect()->back();


        });//END transaction

        return $transaction;


    }//END privacyupdate



    

      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function termsindex()
    {
        //
        //check if user has access
        if(!User::isUserHasAccess(7060)){
            return redirect('/admin/404');
        }

        $globalmessage = GlobalMessage::findOrFail(5000);

        session()->flash('parent_tab', 'Posts');
        session()->flash('child_tab', 'terms.index');

        return view('admin.globalmessage.terms-conditions', compact('globalmessage'));
   
    }//END termsindex



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function termsupdate(Request $request, $id)
    {
        //
        //check if user has access
        if(!User::isUserHasAccess(7060)){
            return redirect('/admin/404');
        }
        
        $globalmessage = GlobalMessage::findOrFail($id);

        //begin transaction
        $transaction = DB::transaction(function() use($request, $globalmessage) {

            $request['fk_updatedby'] = Auth::id();

            $globalmessage->update($request->all());

            session()->flash('success', "record has been updated!");
            return redirect()->back();


        });//END transaction

        return $transaction;


    }//END termsupdate



    
    
}//END class
