<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    public $incrementing = false;
    public $timestamps = false;

    protected $primaryKey = ['user_id', 'uuid', 'type'];

    protected $fillable = ['user_id', 'uuid', 'type', 'display_name','image_url'];
}
