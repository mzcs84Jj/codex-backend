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
        $customer = new Customer(['name' => 'Customer', 'email' => 'c@example.com']);
        $customer->save();
        $product = new Product(['description' => 'Product', 'price' => 5]);
        $product->save();
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
        $customer = new Customer(['name' => 'Create customer', 'email' => 'create@example.com']);
        $customer->save();
        $product1 = new Product(['description' => 'Product 1', 'price' => 10]);
        $product1->save();
        $product2 = new Product(['description' => 'Product 2', 'price' => 3]);
        $product2->save();
        $repository = new SaleRepository();
        $sale = $repository->create([
            'date' => '2024-01-01',
            'customer_id' => $customer->id,
            'products' => [
                ['product_id' => $product1->id, 'quantity' => 2, 'price' => $product1->price],
                ['product_id' => $product2->id, 'quantity' => 1, 'price' => $product2->price],
            ],
        ]);
        $expectedTotal = $product1->price * 2 + $product2->price;

        $this->assertDatabaseHas('sales', ['id' => $sale->id, 'total' => $expectedTotal]);
    }

    public function test_update_modifies_sale(): void
    {
        $customer = new Customer(['name' => 'Update customer', 'email' => 'update@example.com']);
        $customer->save();
        $product = new Product(['description' => 'Product', 'price' => 5]);
        $product->save();
        $repository = new SaleRepository();
        $sale = $repository->create([
            'date' => '2024-01-01',
            'customer_id' => $customer->id,
            'products' => [
                ['product_id' => $product->id, 'quantity' => 1, 'price' => $product->price],
            ],
        ]);
        $newProduct = new Product(['description' => 'New product', 'price' => 7]);
        $newProduct->save();
        $repository->update($sale, [
            'products' => [
                ['product_id' => $newProduct->id, 'quantity' => 3, 'price' => $newProduct->price],
                ['product_id' => $product->id, 'quantity' => 2, 'price' => $product->price],
            ],
        ]);

        $expectedTotal = $newProduct->price * 3 + $product->price * 2;

        $this->assertDatabaseHas('sales', ['id' => $sale->id, 'total' => $expectedTotal]);
    }

    public function test_delete_removes_sale(): void
    {
        $customer = new Customer(['name' => 'Delete customer', 'email' => 'del@example.com']);
        $customer->save();
        $product = new Product(['description' => 'Product', 'price' => 5]);
        $product->save();
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
