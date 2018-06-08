<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    // naming is relate to understanding purpose (plural to many, singular to one)
    public function posts() {
        // one to many relationship
        // if one row data used with various data that is one to many relation
        // the category is a list of categories of the posts
        // one category can be used in many posts but only one post has one category
        // TODO: relationship type: hasMany (a category has many posts)

        return $this->hasMany('App\Post');
    }

}
