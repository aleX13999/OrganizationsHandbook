<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrganizationPhone extends Model
{
    protected $fillable = ['organization_id', 'phone_number'];

    public function organization(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }
}
