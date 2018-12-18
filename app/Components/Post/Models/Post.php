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
        //var_dump(Post::post()->id);
        //var_dump($this->hasMany('App\Components\Image\Models\Image')->where('type', 'thumbnail')->orWhere('type', 'large'));
        //$image = (app(FileServiceContract::class))->get($this->hasMany('App\Components\Image\Models\Image')->where('type', 'thumbnail')->orWhere('type', 'large')->get());
//        $cnt = 0;
//        var_dump($this->hasMany('App\Components\Image\Models\Image')->where('type', 'thumbnail')->orWhere('type', 'large')->get()->groupBy([
//            'uid',
//            function ($item) {
//                return $item['type'];
//            },
//        ], $preserveKeys = true)->mapWithKeys(function ($item) use (&$cnt) {
        $cnt = 0;
        $images = $this->hasMany('App\Components\Image\Models\Image')->where('type', 'thumbnail')->orWhere('type', 'large')->get()->groupBy([
            'uid',
            function ($item) {
                return $item['type'];
            },
        ], $preserveKeys = true)
            ->mapWithKeys(function ($item) use (&$cnt, &$str) {
                $i = $item->map(function ($subItems) use(&$str) {
                    return (app(FileServiceContract::class))->get($subItems->first()['path']);
                });

                $subResult = [$cnt => $i];
                $cnt++;
                return $subResult;
            });
//            $i = $item->map(function ($subItems){
//               return $subItems;
//            });
            //return $item;
//            $subResult = [$cnt => $i];
//            $cnt++;
//            return $subResult;

        //var_dump((app(FileServiceContract::class))->get($this->hasMany('App\Components\Image\Models\Image')->where('type', 'thumbnail')->orWhere('type', 'large')->get()));
        //var_dump($this->getDeleteImages($this->id, $this->hasMany('App\Components\Image\Models\Image')->where('type', 'thumbnail')->orWhere('type', 'large')->get()->mapWithKeys(function ($item){

        //})));
        return $images;//$this->hasMany('App\Components\Image\Models\Image')->where('type', 'thumbnail')->orWhere('type', 'large');
    }

    public function comments()
    {
        return $this->hasMany('App\Components\Comment\Models\Comment');
    }

}
