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
        foreach (range(1, 3) as $i) {
            Product::create(['description' => "Product $i", 'price' => $i]);
        }

        $repository = new ProductRepository();
        $result = $repository->all();

        $this->assertCount(3, $result);
    }

    public function test_create_stores_product(): void
    {
        $data = ['description' => 'Create product', 'price' => 9.99];

        $repository = new ProductRepository();
        $product = $repository->create($data);

        $this->assertDatabaseHas('products', ['id' => $product->id]);
    }

    public function test_update_modifies_product(): void
    {
        $product = Product::create(['description' => 'Old', 'price' => 5]);
        $data = ['description' => 'Updated', 'price' => 6.5];

        $repository = new ProductRepository();
        $repository->update($product, $data);

        $this->assertDatabaseHas('products', ['id' => $product->id, 'description' => $data['description']]);
    }

    public function test_delete_removes_product(): void
    {
        $product = Product::create(['description' => 'Delete', 'price' => 3]);

        $repository = new ProductRepository();
        $repository->delete($product);

        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}
