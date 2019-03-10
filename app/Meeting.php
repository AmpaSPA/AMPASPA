<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    protected $table = 'meetings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fechareunion',
        'horareunion',
        'horafinreunion',
        'meetingtype_id',
        'nota'
    ];

    /**
     * Relación Muchos a Muchos con la tabla asistentes
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function attendees()
    {
        return $this->belongsToMany('App\Attendee', 'attendee_meeting')
            ->withPivot('meeting_id', 'confirmed')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function meetingtype()
    {
        return $this->belongsTo('App\Meetingtype');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function proceeding()
    {
        return $this->hasOne('App\Proceeding');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function topics()
    {
        return $this->hasMany('App\Topic');
    }
}
