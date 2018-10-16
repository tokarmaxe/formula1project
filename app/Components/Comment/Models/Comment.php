<?php

namespace App\Components\Comment\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model implements CommentContract
{
    use SoftDeletes;
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo('App\Components\User\Models\User')->select(array('id', 'first_name', 'last_name', 'avatar'));
    }

    public function post()
    {
        return $this->belongsTo('App\Components\Post\Models\Post');
    }
}
