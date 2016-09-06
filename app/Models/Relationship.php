<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class Relationship extends Model
{
      /**
     * Get the comments for the blog post.
     */
    public function user()
    {
        return $this->hasMany('Models\User');
    }
}
