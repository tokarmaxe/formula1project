<?php
/**
 * Created by PhpStorm.
 * User: sklyack
 * Date: 10.08.18
 * Time: 10:16
 */

namespace App\Components\User\Models;


use App\Components\User\Services\UserContract;

class UserMok implements UserContract
{
    public function getAll() {
        return response()->json([
            'name' => 'Abigail',
            'state' => 'CA'
        ]);
    }

}