<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $product = new \App\Product([
            'imagePath' => 'https://s-media-cache-ak0.pinimg.com/originals/95/ff/50/95ff504ed56a41d7bda58b89d2fa1f2a.jpg',
            'name' => 'Harry Potter',
            'description' => 'Very good book',
            'price' => 10
        ]);
        $product->save();

        $product = new \App\Product([
            'imagePath' => 'https://www.abebooks.com/images/books/harry-potter/sorcerers-stone.jpg',
            'name' => 'Harry Potter 2',
            'description' => 'Very good book',
            'price' => 20
        ]);
        $product->save();

        $product = new \App\Product([
            'imagePath' => 'https://images-na.ssl-images-amazon.com/images/I/51jNORv6nQL._AC_UL320_SR218,320_.jpg',
            'name' => 'Harry Potter 3',
            'description' => 'Very good book',
            'price' => 30
        ]);
        $product->save();

        $product = new \App\Product([
            'imagePath' => 'https://images-na.ssl-images-amazon.com/images/I/71Ui-NwYUmL.jpg',
            'name' => 'Harry Potter 4',
            'description' => 'Very good book',
            'price' => 40
        ]);
        $product->save();

        $product = new \App\Product([
            'imagePath' => 'https://images-na.ssl-images-amazon.com/images/I/51gY5jzz3NL.jpg',
            'name' => 'Harry Potter 5',
            'description' => 'Very good book',
            'price' => 50
        ]);
        $product->save();
    }
}
