<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use illuminate\support\Str;

class Technology extends Model
{
    use HasFactory;

    protected $fillable = ['name','logo'];

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }
}
