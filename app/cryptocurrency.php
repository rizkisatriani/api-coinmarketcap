<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cryptocurrency extends Model
{
    
    protected $table = 'cryptocurrencies'; 

    protected $fillable = ['id', 'name', 'shortcode', 'currentprice', 'update_at' ];


    protected $dates = ['update_at'];
}
