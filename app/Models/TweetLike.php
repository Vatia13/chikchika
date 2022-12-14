<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class TweetLike extends Pivot
{
    protected $table = 'likes';
}
