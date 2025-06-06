<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
    protected $fillable = [
    'title', 'slug', 'content', 'featured_image', 'status', 'published_at'
    ];

    //Category Relationship
    public function category()
    {
        return $this->belongsTo(Category::class);
    }


}
