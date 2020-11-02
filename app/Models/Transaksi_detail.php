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
        return $this->hasMany('App\Models\User');
    }

    public function customers(){
        return $this->hasMany('App\Models\Customer');
    }
    public function payment_method(){
        return $this->hasMany('App\Models\PaymentMethod');
    }
}
