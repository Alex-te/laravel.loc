<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{

    use SoftDeletes, HasFactory;

    protected $fillable = ['title', 'text', 'is_private', 'category_id', 'news_source_id'];

}
