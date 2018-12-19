<?php

namespace App\Components\Post\Models;

use App\Components\File\Services\FileServiceContract;
use App\Convention\Model\Traits\IsoDateTrait;
use function foo\func;
use Illuminate\Database\Eloquent\Model;
use App\Components\Image\Models\Image;
use App\Convention\Model\Traits\ImageTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Post extends Model implements PostContract
{
    use SoftDeletes;
    use IsoDateTrait;
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];
    use ImageTrait;

    public function category()
    {
        return $this->belongsTo('App\Components\Category\Models\Category')->select(array(
            'id',
            'name'
        ));
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
        return $this->hasMany('App\Components\Image\Models\Image')->where('type', 'thumbnail')->orWhere('type', 'large');
    }

    public function comments()
    {
        return $this->hasMany('App\Components\Comment\Models\Comment');
    }
}
