<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meetingtype extends Model
{
    /**
     * @var string
     */
    protected $table = 'meetingtypes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tiporeunion',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function meetings()
    {
            return $this->hasMany('App\Meeting');
    }
}
