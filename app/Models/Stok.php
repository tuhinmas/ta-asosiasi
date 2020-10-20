<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    protected $table = "stok";
    protected $guarded = [];
    public $timestamps = false;

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

    public function product(){
        return $this->hasOne("App\Models\Product");
    }
}
