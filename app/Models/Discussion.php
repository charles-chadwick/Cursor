<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Discussion extends Base
{
    use LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'on',
        'on_type',
        'type',
        'title',
        'status',
        'notes'
    ];

    /**
     * Get the parent-discussable model (User, Company, or Customer).
     */
    public function discussable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get all posts for this discussion.
     */
    public function posts(): HasMany
    {
        return $this->hasMany(DiscussionPost::class);
    }

}

