<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agree extends Model
{
    protected $table = 'agrees';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'topic_id',
        'acuerdo',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function topic()
    {
        return $this->belongsTo('App\Topic');
    }
}
