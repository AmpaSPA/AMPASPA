<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paymenttype extends Model
{
  /**
   * @var string
   */
  protected $table = 'paymenttypes';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'tipopago',
  ];

  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function users()
  {
    return $this->hasMany('App\User');
  }
}
