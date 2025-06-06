<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_all_returns_all_products(): void
    {
        $products = Product::factory()->count(3)->create();

        $repository = new ProductRepository();
        $result = $repository->all();

        $this->assertCount($products->count(), $result);
    }

    public function test_create_stores_product(): void
    {
        $data = Product::factory()->make()->toArray();

        $repository = new ProductRepository();
        $product = $repository->create($data);

        $this->assertDatabaseHas('products', ['id' => $product->id]);
    }

    public function test_update_modifies_product(): void
    {
        $product = Product::factory()->create();
        $data = Product::factory()->make()->toArray();

        $repository = new ProductRepository();
        $repository->update($product, $data);

        $this->assertDatabaseHas('products', ['id' => $product->id, 'description' => $data['description']]);
    }

    public function test_delete_removes_product(): void
    {
        $product = Product::factory()->create();

        $repository = new ProductRepository();
        $repository->delete($product);

        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}
