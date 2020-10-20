<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];
    public $timestamps=false;
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

    public function transaksi(){
        return $this->belongsTo('App\Models\Transaksi');
    }

    public function stok(){
        return $this->hasOne("App\Models\Stok","product_id");
    }
}
