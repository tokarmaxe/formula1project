<?php

namespace App\Components\Comment\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model implements CommentContract
{
    use SoftDeletes;
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo('App\Components\User\Models\User');
    }

    public function post()
    {
        return $this->belongsTo('App\Components\Post\Models\Post');
    }
}