<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $title
 * @property string $description
 * @property mixed $item_id
 * @property mixed $originator_id
 * @property mixed $assignee_id
 */
class Issue extends Model
{
    use HasFactory;

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

}
