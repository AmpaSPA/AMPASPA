<?php

namespace App;

use Spatie\Permission\Traits\HasRoles;
use App\Notifications\ResetearPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property \Carbon\Carbon $created_at
 * @property int $id
 * @property \Carbon\Carbon $deleted_at
 * @property mixed $numdoc
 * @property \Carbon\Carbon $updated_at
 * @property mixed $attributes
 * @property mixed $students
 * @property mixed $profile
 * @property mixed $doctype
 * @property mixed $membertype
 * @property mixed $paymenttype
 */
class User extends Authenticatable
{
    use Notifiable,  SoftDeletes, HasRoles;

    /**
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'apellidos',
        'email',
        'password',
        'telefono',
        'doctype_id',
        'numdoc',
        'membertype_id',
        'paymenttype_id',
        'corrientepago',
        'reciboimportado',
        'firmacorrecta',
        'firmaimportada',
        'activo',
        'rol_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token'
    ];

  /**
   * @param $value
   */
    public function setNumdocAttribute($value)
    {
        $this->attributes['numdoc'] = strtoupper($value);
    }

    /**
     * Obtener el nombre y tipo de curso.
     *
     * @return string
     */
    public function getFullnameAttribute()
    {
        return $this->nombre . ' ' . $this->apellidos;
    }

  /**
   * Send the password reset notification.
   *
   * @param  string  $token
   * @return void
   */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetearPassword($token));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function students()
    {
        return $this->hasMany('App\Student');
    }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasOne
   */
    public function profile()
    {
        return $this->hasOne('App\Profile');
    }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
    public function doctype()
    {
        return $this->belongsTo('App\Doctype');
    }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
    public function membertype()
    {
        return $this->belongsTo('App\Membertype');
    }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
    public function paymenttype()
    {
        return $this->belongsTo('App\Paymenttype');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function warnings()
    {
        return $this->hasMany('App\Warning');
    }

}
