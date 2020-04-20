<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Logs extends Model
{
  use SoftDeletes;


  protected $connection = 'mysql';
  protected $table = 'logs';
  protected $guarded = [];
  protected $dates = ['deleted_at'];

  public function scopeCreatedAt($query,$fechaInicio,$fechaFin){
    if($fechaInicio && $fechaFin){
             return $query->whereBetween('created_at',[$fechaInicio." 00:00:00", $fechaFin." 23:59:59"]);
    }
  }

}
