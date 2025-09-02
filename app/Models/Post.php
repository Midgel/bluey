<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_category',
        'title',
        'image',
        'body',
        'author',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category');
    }
}
