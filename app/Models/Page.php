<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Page extends Model
{
    use HasFactory;

    public function scopeRecent($query)
    {
        $query->latest();
    }

    public function image(): Attribute
    {
        return Attribute::make(get: fn ($value) => Storage::disk('public')->url($value));
    }
}
