<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Catatan extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'title',
        'slug',
        'catatan',
        'images',
        'status',
        'type',
        'categories',
        'tags',
        'target',
        'collected',
        'tanggal',
    ];

    protected $casts = [
        'images' => 'array',
        'tags' => 'array',
        'tanggal' => 'array',
    ];
}
