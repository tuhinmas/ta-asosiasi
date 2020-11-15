<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Transaksi_detail extends Model
{
    protected $guarded = [];
    protected $table = 'transaksi_detail';
    // public $timestamps=false;
    // protected $table = 'products';

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

    public function user(){
        return $this->hasOne('App\User','id','user_id');
    }

    public function customers(){
        return $this->hasOne('App\Models\Customer','id','customer_id');
    }
    public function payment_method(){
        return $this->hasOne('App\Models\PaymentMethod','id','payment_method');
    }

    public function transaksi(){
        return $this->hasMany('App\Models\Transaksi','invoice','invoice');
    }
}
