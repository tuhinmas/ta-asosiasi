<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Hash1 extends Model
{
    protected $table = "hash_1";
    protected $guarded = [];
    protected static function boot(){
        parent::boot();
        static::creating(function($model){
            if(! $model->getKey()){
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    public function getIncrementing(){
        return false;
    }

    public function getKeyType(){
        return 'string';
    }

    public function products(){
        return $this->hasMany('App\Models\Product','id');
    }

    public function transaksi(){
        return $this->hasMany('App\Models\Transaksi','product_id','product_id');
    }

    public function order(){
        return $this->hasOne('App\Models\Order','product_id','product_id');
    }

    public function hash_1(){
        return $this->hasMany('App\Models\Hash1','link','link');
    }

    public function coba(){
        return $this->hasMany('App\Models\Hash1','link','link');
    }

    public function product_1(){
        return $this->hasOne('App\Models\Product','id','product_id');
    }
}
