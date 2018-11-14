<?php

namespace App\Components\Post\Models;

use App\Convention\Model\Traits\IsoDateTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Post extends Model implements PostContract
{
    use SoftDeletes;
    use IsoDateTrait;
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];


    public function category()
    {
        return $this->belongsTo('App\Components\Category\Models\Category');
    }

    public function user()
    {
        return $this->belongsTo('App\Components\User\Models\User')->select(array(
            'id',
            'first_name',
            'last_name',
            'avatar',
            'email',
            'phone_number',
            'skype',
            'room_location',
            'telegram',
        ));
    }

    public function images()
    {
        return $this->hasMany('App\Components\Image\Models\Image');
    }

    public function comments()
    {
        return $this->hasMany('App\Components\Comment\Models\Comment');
    }

}
