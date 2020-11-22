<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = "transaksi";
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
        return $this->hasOne('App\Models\Product','id','product_id');
    }

    public function transaksi_detail(){
        return $this->belongsTo('App\Models\Transaksi_detail','invoice','invoice');
    }

    public function hash_2(){
        return $this->belongsToMany('App\Models\Transaksi','hash_2','product_id_1','product_id_2')->withPivot('invoice');
    }
}
