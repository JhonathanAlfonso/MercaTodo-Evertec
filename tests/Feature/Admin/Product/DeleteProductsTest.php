<?php

namespace Tests\Feature\Admin\Product;

use App\Constants\Permissions;
use App\Constants\PlatformRoles;
use App\Entities\User;
use App\Entities\Product;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteProductsTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * @test
     */
    public function guestCantDeleteProducts()
    {
        $product = factory(Product::class)->create();

        $this->delete(route('admin.products.destroy', $product))
            ->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function buyerCantDeleteProducts()
    {
        $buyerUser = factory(User::class)->create();
        $this->actingAs($buyerUser);

        $product = factory(Product::class)->create();

        $this->delete(route('admin.products.destroy', $product))
            ->assertStatus(403);
    }

    /**
     * @test
     */
    public function adminWithPermissionCanDeleteProducts()
    {
        $deleteProductPermission = Permission::create(['name' => Permissions::DELETE_PRODUCTS]);
        $adminRole = Role::create(['name' => PlatformRoles::ADMIN])->givePermissionTo($deleteProductPermission);
        $admUser = factory(User::class)->create()->assignRole($adminRole);
        $product = factory(Product::class)->create();
        $this->actingAs($admUser);

        $this->delete(route('admin.products.destroy', $product))
            ->assertRedirect(route('admin.products.index'));

        $this->assertDeleted('products', array($product));
    }

    /**
     * @test
     */
    public function adminWithoutPermissionCantDeleteProducts()
    {
        Permission::create(['name' => Permissions::DELETE_PRODUCTS]);
        $adminRole = Role::create(['name' => PlatformRoles::ADMIN]);
        $admUser = factory(User::class)->create()->assignRole($adminRole);
        $product = factory(Product::class)->create();
        $this->actingAs($admUser);

        $this->delete(route('admin.products.destroy', $product))
            ->assertStatus(403);
    }
}
