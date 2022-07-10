<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopePopular($query)
    {
        $query->orderBy('views', 'desc');
    }

    public function scopeRecent($query)
    {
        $query->orderBy('created_at', 'desc');
    }

    public function image(): Attribute
    {
        return Attribute::make(get: fn ($value) => Storage::disk('public')->url($value));
    }
}
