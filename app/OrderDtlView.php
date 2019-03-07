<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDtlView extends Model
{
    //
    protected $table = 'vw_orderdtls';

    protected $primaryKey = 'fk_ordermstr';

}
