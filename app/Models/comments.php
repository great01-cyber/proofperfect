<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['comment']; // only store the comment text

    // Optional: hide id in API responses if you want full anonymity
    protected $hidden = ['id', 'created_at', 'updated_at'];
}
