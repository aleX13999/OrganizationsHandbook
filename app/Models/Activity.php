<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = ['name', 'parent_id'];

    public function parent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Activity::class, 'parent_id');
    }

    public function children(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Activity::class, 'parent_id');
    }

    public function organizations(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Organization::class, 'organization_activities');
    }

    // Рекурсивное получение дерева с ограничением глубины
    public function getTree(int $maxDepth = 3, int $currentDepth = 1)
    {
        if ($currentDepth > $maxDepth) {
            return collect();
        }

        $this->load('children');

        $this->children->each(
            function ($child) use ($maxDepth, $currentDepth)
            {
                $child->setRelation('children', $child->getTree($maxDepth, $currentDepth + 1));
            },
        );

        return $this->children;
    }
}
