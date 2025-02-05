<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Discussion extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'text', 'author_id','image'];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
