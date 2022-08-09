<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string $name
 * @property mixed $item_id
 * @property string $image_path
 */
class Image extends Model
{
    use HasFactory;

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function issue(): BelongsTo
    {
        return $this->belongsTo(Issue::class);
    }
}
