<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mensajes extends Model
{
  protected $connection = 'mysql';
  protected $table = 'mensajes';
  protected $guarded = [];
}
