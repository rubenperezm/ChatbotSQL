<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Ejercicio extends Model
{
  use SoftDeletes;


  protected $connection = 'mysql';
  protected $table = 'ejercicio';
  protected $guarded = [];
  protected $dates = ['deleted_at'];

}
