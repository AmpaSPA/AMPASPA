<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
  /**
   * @var string
   */
  protected $table = 'periods';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'periodo',
    'cuota',
    'activo',
  ];
}
