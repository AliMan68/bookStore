<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'title',
        'price',
        'image',
        'count',
        'discount_percent',
        'page_count',
        'editor',
        'isbn',
        'attachment',
        'credits',
        'book_year',
        'published',
        'publication_frost',
        'cut',
        'cover',
        'about'
    ];

    public function translators(){
        return $this->belongsToMany(Translator::class);
    }
    public function authors(){
        return $this->belongsToMany(Author::class);
    }
    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function comments(){
        return $this->morphMany(Comment::class,'commentable');
    }

    public function orders(){
        return $this->belongsToMany(Order::class)->withPivot('quantity','price','book_year','credits');
    }

    public function PublishmentRequests(){
        return $this->belongsToMany(PublishmentRequest::class);
    }
}
