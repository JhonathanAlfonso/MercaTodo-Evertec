<?php

namespace Tests\Feature\Cart;

use App\Product;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class IndexCartProductTest extends TestCase
{

    use RefreshDatabase;


    /**
     * @test
     */
    public function guestCantIndexCartProduct()
    {
        $this->get(route('cart.index'))->assertRedirect(route('login'));
    }


    /**
     * @test
     */
    public  function buyerCanIndexCartProduct()
    {
        $buyerRole = Role::create(['name' => 'Buyer']);
        $buyerUser = factory(User::class)->create()->assignRole($buyerRole);
        $this->actingAs($buyerUser);

        $product = factory(Product::class)->create();
        $_REQUEST['quantity'] = 1;

        $this->get(route('cart.add', compact('product')))
            ->assertStatus(302);

        $response = $this->get(route('cart.index'));

        $response->assertSee($product->name);
        $response->assertSee($product->price);
    }


    /**
     * @test
     */
    public function adminCantIndexCartProduct()
    {
        $adminRole = Role::create(['name' => 'Admin']);
        $adminUser = factory(User::class)->create()->assignRole($adminRole);
        $this->actingAs($adminUser);

        $this->get(route('cart.index'))->assertStatus(403);
    }
}