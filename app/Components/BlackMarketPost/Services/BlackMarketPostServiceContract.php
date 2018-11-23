<?php


namespace App\Components\BlackMarketPost\Services;


interface BlackMarketPostServiceContract
{
    public function list();

    public function store($data);

    public function destroy($postId);

    public function update($data, $postId);


}