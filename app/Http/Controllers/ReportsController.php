<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth; //responsible for our authentication 

use Illuminate\Support\Facades\DB; //responsible for DB

use Exception;

use App\PDOErr;

use App\MyHelperClass;

use Carbon\Carbon;

use App\User;
use App\UserType;

use App\UserMstrView;
use App\UserAbandonedCartMstrView;

use App\OrderMstrView;
use App\ReportOrderDtls; // specefic view for reporting

use App\Exports\ExportFromView;
use Maatwebsite\Excel\Facades\Excel;


class ReportsController extends Controller
{
    //
    

	public $menu_group = 'reports.index';

    public function __construct(){
        $this->middleware(['auth'])->except([]);
    }

    public function setActiveTab(){
        session()->flash('parent_tab', 'Reports');
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
        if(!User::isUserHasAccess(10000)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();

       
        $search = ( request()->search ) ? request()->search : '';

        $uid = Auth::id();

       	$reports = DB::select("CALL usp_getAssignedReports($uid, '%$search%')");

        //$sub_menu = User::getSubMenu(Auth::id(), $this->menu_group);
        //dd($sub_menu);

        return view('admin.reports.index', compact('reports', 'search'));


    }//END index



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generate($id)
    {
        //
        
        //check if user has access
        if(!User::isUserHasAccess($id)){
            return redirect('/admin/404');
        }

        $this->setActiveTab();

        return $this->reports($id);
     

    }//END generate





    public function reports($id){


    	$permalink = DB::select("SELECT * FROM permalink where pk_permalink = '$id'; ");

      if( count($permalink) > 0 ){

      	$permalink = $permalink[0];

      }else{

      	return redirect('/admin/404');

      } 


      $search = ( request()->search ) ? request()->search : null;

      $datefrom = ( request()->datefrom ) ? request()->datefrom : date('Y-m-d');

      $dateto = ( request()->dateto ) ? request()->dateto : date('Y-m-d');

      $export = ( request()->export ) ? request()->export : 'false';


      switch($id){

        //10001 = List of customers
        case '10001':
         
          $type = ( request()->type ) ? request()->type : 'customers';

          //10 = type
          $filters = [10];

          $result = $this->reports_10001($search, $type);

          //dd($result);
          

          if($export == 'true'){

            return Excel::download(new ExportFromView('admin.reports.10001', [
              'result'=> $result, 
              'type'=> $type, 
            ]), "$type list.csv");

          }//END $export == 'true'
          
          return view("admin.reports.create", compact('permalink', 'result', 'search', 'filters', 'type'));


        break;

        //Sales Orders
        case '10002':

          $displaytype = ( request()->displaytype ) ? request()->displaytype : 'summary';

          //1  = [datefrom, dateto]
          //11 = displaytype ['summary', 'details']
          $filters = [1, 11];

          $result = $this->reports_10002($search, $displaytype, $datefrom, $dateto);

          //dd($result);
 
          if($export == 'true'){

            return Excel::download(new ExportFromView('admin.reports.10002-'.$displaytype, [
              'result'=> $result, 
              'datefrom'=> $datefrom, 
              'dateto'=> $dateto,
              'displaytype'=> $displaytype
            ]), "Order $displaytype - $datefrom to $dateto.csv");

          }//END $export == 'true'

          return view("admin.reports.create", compact('permalink', 'result', 'search', 'filters', 'displaytype', 'datefrom', 'dateto'));


        break;

        default:

          //report id not found
          return redirect('/admin/404');


      }//END switch

        

    }//END reports



    //10001 = List of customers
   	public function reports_10001($search, $type){

   		$result = [];

   		switch($type){

   			case 'customers':

   				$result = UserMstrView::purchaser();

   			break;

   			case 'leads':

   				$result = UserMstrView::leads();

   			break;

   			case 'abandoned':

   				$result = UserAbandonedCartMstrView::all();

   			break;

   			case 'opt-out':

   				$result = UserMstrView::optout();

   			break;


   			default:


   		}//END switch

   		return $result;

   	}//END reports_10001


    //10002 = Sales Orders
    public function reports_10002($search, $displaytype, $datefrom, $dateto){

      $result = [];

      switch($displaytype){

        case 'summary':

          $result = OrderMstrView::ordersummary_date($datefrom, $dateto);

        break;

        case 'details':

          $result = ReportOrderDtls::orderdtls_date($datefrom, $dateto);

        break;

        default:


      }//END switch

      return $result;

    }//END reports_10002


}//END class
