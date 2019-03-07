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

    
    
    
}//END class
