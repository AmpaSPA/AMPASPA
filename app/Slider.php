<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
  /**
   * @var string
   */
  protected $table = 'sliders';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'enlacehref',
    'imagensrc',
    'caption',
    'textohref',
    'activo',
  ];
}
