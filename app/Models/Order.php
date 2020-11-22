<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
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

    public function hash_1(){
        return $this->belongsToMany('App\Models\Hash1','hash_2','product_id_1','product_id_2')
        ->withPivot('product_id')
        ->withTimestamps();
    }
}
