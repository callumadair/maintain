<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

/**
 * @property string $name
 * @property string $image_path
 * @property mixed $item_id
 * @property mixed $issue_id
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

    protected static function booted()
    {
        parent::booted();

        static::deleted(function ($image) {
            //remove storage/ form the path
            $relative_path = substr($image->image_path, 8);
            Storage::disk('public')->delete($relative_path);
        });
    }
}
