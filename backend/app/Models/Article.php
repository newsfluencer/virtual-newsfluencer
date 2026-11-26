<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['title', 'body', 'source_uri', 'source_title', 'image', 'published_at'])]
class Article extends Model
{
    use HasFactory;
}
