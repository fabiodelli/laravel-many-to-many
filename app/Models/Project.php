<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'cover_image', 'completed', 'slug'];

    public function technologies():BelongsToMany
    {
        return $this->belongsToMany(Technology::class);
    }
    public static function generateSlug($title)
    {
        return Str::slug($title, '-');
    }
    public function type():BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

}