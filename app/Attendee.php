<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendee extends Model
{
    protected $table = 'attendees';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'nombre',
        'numdoc'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function meetings()
    {
        return $this->belongsToMany('App\Meeting', 'attendee_meeting')->withPivot('attendee_id', 'confirmed')->withTimestamps();
    }
}
