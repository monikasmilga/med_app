<?php

namespace App\Models\Traits;
use Ramsey\Uuid\Uuid;

/**
 * Created by PhpStorm.
 * User: Monika
 * Date: 9/7/2017
 * Time: 9:00 AM
 */
trait UuidTrait
{

    protected static function boot(){
        parent::boot();
        static::creating(function($model) {
            if(!isset($model->attributes['id'])) {
                $model->attributes['id'] = Uuid::uuid4();
            } else {
                $model->{$model->getKeyName()} = $model->attributes['id'];
            }
        });
    }
}