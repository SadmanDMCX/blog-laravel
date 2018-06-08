<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'content', 'featured', 'category_id', 'slug', 'user_id'];

    protected $dates = ['deleted_at'];

    public function getFeaturedAttribute($featured) {
        return asset($featured);
    }

    // naming is relate to understanding purpose (plural to many, singular to one)
    public function category() {
        // many to one relationship
        // if many rows use a single data from another table that is a many to one relationship
        // tha post is the post of the blogs
        // many post can be under same category
        // TODO: relationship type: belongsTo (many posts has a single category)

        return $this->belongsTo('App\Category');
    }

    public function tags() {
        return $this->belongsToMany('App\Tag');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
