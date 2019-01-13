<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activitytype extends Model
{
  /**
   * @var string
   */
  protected $table = 'activitytypes';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'tipoactividad',
  ];

  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function activities()
  {
    return $this->hasMany('App\Activity');
  }
}