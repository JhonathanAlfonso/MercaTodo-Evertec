<?php

use App\Entities\Tag;
use App\Entities\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run(): void
    {
        Product::truncate();
        Tag::truncate();

        // Productos caracteristicos
        $product1 = factory(Product::class)->create(['category_id' => 2]);
        $product1->tags()->attach(Tag::create(['name' => 'mujer']));

        $product2 = factory(Product::class)->create(['category_id' => 2]);
        $product2->tags()->sync(1);

        $product3 = factory(Product::class)->create(['category_id' => 2]);
        $product3->tags()->sync(1);

        $product4 = factory(Product::class)->create(['category_id' => 2]);
        $product4->tags()->sync(1);

        // Ultimos productos
        $product5 = factory(Product::class)->create(['category_id' => 3]);
        $product5->tags()->attach(Tag::create(['name' => 'hombre']));

        $product6 = factory(Product::class)->create(['category_id' => 3]);
        $product6->tags()->sync(2);

        $product7 = factory(Product::class)->create(['category_id' => 3]);
        $product7->tags()->sync(2);

        $product8 = factory(Product::class)->create(['category_id' => 3]);
        $product8->tags()->sync(2);
    }
}
