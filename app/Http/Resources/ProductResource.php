<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ProductResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'productid'=> $this->pk_products,
            'groupname'=> $this->groupname,
            'groupdesc'=> $this->groupdesc,
            'groupdesc2'=> $this->groupdesc2,
            'groupdesc3'=> $this->groupdesc3,
            'flavors'=> $this->flavors,
            'name'=> $this->name,
            'slug'=> $this->slug,
            'metadata'=> $this->metadata,
            'description'=> $this->description,
            'price'=> $this->price,
            'discountedprice'=> $this->discountedprice,
            'price2'=> $this->price2,
            'discrate'=> $this->discount,
            'taxrate'=> $this->taxdate,
            'shippingcost'=> $this->shippingcost,
            'cartprice'=> $this->cartprice,
            'cartdiscount'=> $this->cartdiscount,
            'cartdiscountedprice'=> $this->cartdiscountedprice,
            'qty'=> $this->qty,
            'totalsalesqty'=> $this->totalsalesqty,
            'selectedqty'=> ( isset($this->selectedqty) ) ? $this->selectedqty : 1, //default 1
            'uom'=> $this->uom,
            'pictxa'=> $this->pictxa,
            'videoshare'=> $this->videoshare,
            'ratings'=> $this->ratings,
            'ratings2'=> $this->ratings2,
        ];
        //return parent::toArray($request);
    }
}
