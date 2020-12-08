<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Hash3 extends Model
{
    protected $table = "hash_3";

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

    public function id_1(){
        return $this->hasOne('App\Models\Product','id','product_id_1',);
    }
    public function id_2(){
        return $this->hasOne('App\Models\Product','id','product_id_2',);
    }
    public function id_3(){
        return $this->hasOne('App\Models\Product','id','product_id_3',);
    }
}
