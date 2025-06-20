<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'nama',
        'kontak',
        'tglawal',
        'tglakhir',
        'tujuan',
        'terbayar',
        'harga',
        'narahubung',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
