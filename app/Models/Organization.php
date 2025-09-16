<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $fillable = ['name', 'building_id'];

    public function building(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Building::class);
    }

    public function activities(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Activity::class, 'organization_activities');
    }

    public function phones(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(OrganizationPhone::class);
    }
}
