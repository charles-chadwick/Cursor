<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\MorphTo;

class Contact extends Base
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'on',
        'on_type',
        'type',
        'is_primary',
        'address_1',
        'address_2',
        'city',
        'state',
        'postal_code',
        'country',
        'notes'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_primary' => 'boolean',
        ];
    }

    /**
     * Get the parent-contactable model (Company or Customer).
     */
    public function contactable(): MorphTo
    {
        return $this->morphTo();
    }
}

