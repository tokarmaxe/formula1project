<?php


namespace App\Components\Post\Services;

use Illuminate\Http\Request as Request;


interface PostServiceContract
{
    public function list();
    public function create(Request $request);

}