<?php

namespace App\Models;

use App\Models\Hash1;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];
    // protected static function boot(){
    //     parent::boot();
    //     static::creating(function($model){
    //         if(! $model->getKey()){
    //             $model->{$model->getKeyName()} = (string) Str::uuid();
    //         }
    //     });
    // }

    // public function getIncrementing(){
    //     return false;
    // }

    // public function getKeyType(){
    //     return 'string';
    // }

    public function products(){
        return $this->hasOne('App\Models\Product','id','product_id');
    }

    public function transaksi(){
        return $this->hasMany('App\Models\Transaksi','product_id','product_id')->orderBy('created_at');
    }
    public function xxx(){
        return $this->hasMany('App\Models\Hash1');
    }

    public function hash_1(){
        return $this->hasMany('App\Models\Hash1','product_id','product_id');
    }
}
