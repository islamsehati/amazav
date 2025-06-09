<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Armada extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'slug',
        'description',
        'status',
        'images',

        'type',
        'categories',
        'tags',

        'price',
    ];

    protected $casts = [
        'images' => 'array',
        'tags' => 'array',
    ];
}
