<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsInformation extends Model
{
    use HasFactory;

    protected $table = 'news_information';

    protected $fillable = [
        'header_image',
    ];
}
