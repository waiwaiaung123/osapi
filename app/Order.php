<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'voucherno', 'orderdate','status','note','user_id','total'
    ];

    public function items($value='')
    {
    	return $this->belongsToMany('App\Item','order_detail')
    				->withPivot('qty')
    				->withTimestamps();
    }
}
