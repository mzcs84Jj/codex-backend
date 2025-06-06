<?php

namespace Tests\Unit;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Repositories\SaleRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SaleRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_all_returns_all_sales(): void
    {
        $customer = Customer::factory()->create();
        $product = Product::factory()->create();
        $repository = new SaleRepository();
        $repository->create([
            'date' => '2024-01-01',
            'customer_id' => $customer->id,
            'products' => [
                ['product_id' => $product->id, 'quantity' => 1, 'price' => $product->price],
            ],
        ]);

        $result = $repository->all();

        $this->assertCount(1, $result);
    }

    public function test_create_stores_sale(): void
    {
        $customer = Customer::factory()->create();
        $product = Product::factory()->create();
        $repository = new SaleRepository();
        $sale = $repository->create([
            'date' => '2024-01-01',
            'customer_id' => $customer->id,
            'products' => [
                ['product_id' => $product->id, 'quantity' => 2, 'price' => $product->price],
            ],
        ]);

        $this->assertDatabaseHas('sales', ['id' => $sale->id, 'total' => $product->price * 2]);
    }

    public function test_update_modifies_sale(): void
    {
        $customer = Customer::factory()->create();
        $product = Product::factory()->create();
        $repository = new SaleRepository();
        $sale = $repository->create([
            'date' => '2024-01-01',
            'customer_id' => $customer->id,
            'products' => [
                ['product_id' => $product->id, 'quantity' => 1, 'price' => $product->price],
            ],
        ]);
        $newProduct = Product::factory()->create();
        $repository->update($sale, [
            'products' => [
                ['product_id' => $newProduct->id, 'quantity' => 3, 'price' => $newProduct->price],
            ],
        ]);

        $this->assertDatabaseHas('sale_products', ['sale_id' => $sale->id, 'product_id' => $newProduct->id]);
    }

    public function test_delete_removes_sale(): void
    {
        $customer = Customer::factory()->create();
        $product = Product::factory()->create();
        $repository = new SaleRepository();
        $sale = $repository->create([
            'date' => '2024-01-01',
            'customer_id' => $customer->id,
            'products' => [
                ['product_id' => $product->id, 'quantity' => 1, 'price' => $product->price],
            ],
        ]);
        $repository->delete($sale);

        $this->assertDatabaseMissing('sales', ['id' => $sale->id]);
    }
}
