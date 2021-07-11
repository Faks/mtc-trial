<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    /**
     * @var string
     */
    protected $table = 'users';

    protected $fillable = ['username', 'password'];

    protected $hidden = ['id'];

}