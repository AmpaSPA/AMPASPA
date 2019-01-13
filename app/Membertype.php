<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Membertype extends Model
{
  /**
   * @var string
   */
  protected $table = 'membertypes';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'tiposocio',
  ];

  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function users()
  {
    return $this->hasMany('App\User');
  }
}
