<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //Product model maps to products table in eShop database, you can see it in documentation
    //single for model, plural for database table
    protected $fillable = ['imagePath', 'name', 'description', 'price'];
}
