<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth; //responsible for our authentication 

use Illuminate\Support\Facades\DB; //responsible for DB

class ProductPriceListMstrView extends Model
{
    //
    
    protected $table = 'vw_productspricelist';


    //$productids = [1,2,3,4]
    public static function getProductPriceList($productids = []){
    	return static::whereIn('fk_products', $productids)
    		->orderBy('usertype', 'ASC')->get();
    }


    //map / combine price list with the product model
    //jsusertype = manual setting of usertype. this is applicable when we are calling this function inside an ajax request. for some reason, ajax request are authenticated. needs to manually set the usertype using the isloggedin variable. 
    public static function mapProductPriceList($products = [], $pricelist = [], $jsusertype = ''){

        //check if $products is array using index [0]
        //if not array meaning our $products only have one value. and being retreive in the model using either first or findOrFail
        if( $products[0] ){
            //array. our first index is not null
            return static::mapProductPriceListArray($products, $pricelist, $jsusertype);
        }else{
            //not array but an object. our first index is null
            return static::mapProductPriceListOneObject($products, $pricelist, $jsusertype);
        }


    }//END mapProductPriceList



    public static function mapProductPriceListArray($products = [], $pricelist = [], $jsusertype = ''){

        $i = 0;
        foreach ($products as $k1 => $v1) {

            $products[$i]['pricestr'] = "<b>Price List</b> <br><table class='table-bordered'><thead><th>User Type</th><th>Price</th></thead><tbody>";  
            $products[$i]['pricelist'] = []; //initial array
            $tempprices = [];
            $xx = 0; //index for pricelist

            //setup cart price based on the usertype of the loggedin user
            //if user is not logged in then use the default price
            //else check the pricelist for logged in user
            $products[$i]['cartprice'] = $products[$i]->price; //default
            $products[$i]['cartdiscount'] = $products[$i]->discount; //default
            $products[$i]['cartdiscountedprice'] = $products[$i]->discountedprice; //default


            //loop pricelist
            foreach($pricelist as $k2 => $v2){

                if( $v1->pk_products == $v2->fk_products ){

                    //return ($jsusertype == $v2->fk_usertype) ? 'yes' : 'no';

                    //setup cart price based on the usertype of the loggedin user
                    //if user is not logged in then use the default price
                    //else check the pricelist for logged in user
                    if( ( Auth::check() && Auth::user()->fk_usertype == $v2->fk_usertype ) || ($jsusertype == ''.$v2->fk_usertype) ){

                        $products[$i]['cartprice'] = $v2->price;
                        $products[$i]['cartdiscount'] = $v2->discount;
                        $products[$i]['cartdiscountedprice'] = $v2->discountedprice;

                    }//END if Auth::check()

                    $products[$i]['pricestr'] .= "<tr><td>".$v2->usertype .'</td><td>$'. $v2->discountedprice.'</td></tr>';

                    $tempprices[$xx++] = $v2;

                }

            }//END foreach $pricelist


            $products[$i]['pricelist'] = $tempprices; //set actual array of prices
            $products[$i]['pricestr'] .= "</tbody></table>";


            $i++;

        }//END foreach $products

        return $products;

    }//END mapProductPriceListArray



    public static function mapProductPriceListOneObject($products, $pricelist, $jsusertype){


        $products['pricestr'] = "<b>Price List</b> <br><table class='table-bordered'><thead><th>User Type</th><th>Price</th></thead><tbody>";  
        $products['pricelist'] = []; //initial array
        $tempprices = [];
       
        $xx = 0; //index for pricelist

        //setup cart price based on the usertype of the loggedin user
        //if user is not logged in then use the default price
        //else check the pricelist for logged in user
        $products['cartprice'] = $products->price; //default
        $products['cartdiscount'] = $products->discount; //default
        $products['cartdiscountedprice'] = $products->discountedprice; //default


        //loop pricelist
        foreach($pricelist as $k2 => $v2){

            if( $products->pk_products == $v2->fk_products ){

                //return ($jsusertype == $v2->fk_usertype) ? 'yes' : 'no';

                //setup cart price based on the usertype of the loggedin user
                //if user is not logged in then use the default price
                //else check the pricelist for logged in user
                if( ( Auth::check() && Auth::user()->fk_usertype == $v2->fk_usertype ) || ($jsusertype == ''.$v2->fk_usertype) ){

                    $products['cartprice'] = $v2->price;
                    $products['cartdiscount'] = $v2->discount;
                    $products['cartdiscountedprice'] = $v2->discountedprice;

                }//END if Auth::check()

                $products['pricestr'] .= "<tr><td>".$v2->usertype .'</td><td>$'. $v2->discountedprice.'</td></tr>';

                $tempprices[$xx++] = $v2;

            }

        }//END foreach $pricelist


        $products['pricelist'] = $tempprices; //set actual array of prices
        $products['pricestr'] .= "</tbody></table>";

        return $products;

    }//END mapProductPriceListOneObject



    public static function sortProductByPrice($products, $type){

        $size =count($products);
        for($i=0; $i<$size; $i++){
            /* 
             * Place currently selected element array[i]
             * to its correct place.
             */
            for($j=$i+1; $j<$size; $j++)
            {
                /* 
                 * Swap if currently selected array element
                 * is not at its correct position.
                 */
                if( $type == 'asc'  && $products[$i]->cartprice > $products[$j]->cartprice ){

                    $temp     = $products[$i];
                    $products[$i] = $products[$j];
                    $products[$j] = $temp;

                }

                elseif( $type == 'desc' && $products[$i]->cartprice < $products[$j]->cartprice  ){

                    $temp     = $products[$j];
                    $products[$j] = $products[$i];
                    $products[$i] = $temp;

                }
                
            }//END for

        }//END for

        return $products;

    }//END sortProductByPrice

}//END class
