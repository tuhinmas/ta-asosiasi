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
}
