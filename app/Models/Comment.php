<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['text', 'author_id', 'discussion_id', 'parent_id'];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }


    /**
     * Get the parent comment if this is a reply.
     */
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function discussion()
    {
        return $this->belongsTo(Discussion::class);
    }
    public function children()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
