<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class UserImages extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'image_path',
        'image_name',
    ];
}
