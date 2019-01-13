<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activitytarget extends Model
{
  /**
   * @var string
   */
  protected $table = 'activitytargets';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'destinoactividad',
    'colectivo',
  ];

  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function activities()
  {
    return $this->hasMany('App\Activity');
  }
}
