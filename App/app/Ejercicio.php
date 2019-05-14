<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ejercicio extends Model
{
  protected $connection = 'mysql';
  protected $table = 'ejercicio';
  protected $guarded = [];
}
