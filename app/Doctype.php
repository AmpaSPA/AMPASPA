<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctype extends Model
{
  /**
   * @var string
   */
  protected $table = 'doctypes';

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'tipodoc',
  ];

  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function users()
  {
    return $this->hasMany('App\User');
  }
}
