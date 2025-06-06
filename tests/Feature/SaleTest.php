<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\Product;
use App\Services\SaleService;
use App\Repositories\SaleRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SaleTest extends TestCase
{
    use RefreshDatabase;

    private function createSale(): void
    {
        $service = new SaleService(new SaleRepository());
        $customer = Customer::factory()->create();
        $product = Product::factory()->create();
        $service->create([
            'date' => now()->toDateString(),
            'customer_id' => $customer->id,
            'products' => [
                ['product_id' => $product->id, 'quantity' => 1, 'price' => $product->price],
            ],
        ]);
    }

    public function test_index_returns_sales(): void
    {
        $this->createSale();

        $response = $this->getJson('/api/sales');

        $response->assertOk()->assertJsonCount(1);
    }

    public function test_store_creates_sale(): void
    {
        $customer = Customer::factory()->create();
        $product = Product::factory()->create();
        $data = [
            'date' => now()->toDateString(),
            'customer_id' => $customer->id,
            'products' => [
                ['product_id' => $product->id, 'quantity' => 2, 'price' => $product->price],
            ],
        ];

        $response = $this->postJson('/api/sales', $data);

        $response->assertCreated()->assertJsonFragment(['customer_id' => $customer->id]);
        $this->assertDatabaseHas('sales', ['id' => $response->json('id'), 'total' => $product->price * 2]);
        $this->assertDatabaseHas('sale_products', ['sale_id' => $response->json('id'), 'product_id' => $product->id]);
    }

    public function test_show_returns_sale(): void
    {
        $this->createSale();
        $saleId = 1;

        $response = $this->getJson("/api/sales/{$saleId}");

        $response->assertOk()->assertJson(['id' => $saleId]);
    }

    public function test_update_modifies_sale(): void
    {
        $service = new SaleService(new SaleRepository());
        $customer = Customer::factory()->create();
        $product = Product::factory()->create();
        $sale = $service->create([
            'date' => now()->toDateString(),
            'customer_id' => $customer->id,
            'products' => [
                ['product_id' => $product->id, 'quantity' => 1, 'price' => $product->price],
            ],
        ]);
        $newProduct = Product::factory()->create();
        $data = [
            'date' => now()->addDay()->toDateString(),
            'products' => [
                ['product_id' => $newProduct->id, 'quantity' => 3, 'price' => $newProduct->price],
            ],
        ];

        $response = $this->putJson("/api/sales/{$sale->id}", $data);

        $response->assertOk()->assertJsonFragment(['total' => $newProduct->price * 3]);
        $this->assertDatabaseHas('sale_products', ['sale_id' => $sale->id, 'product_id' => $newProduct->id]);
    }

    public function test_destroy_deletes_sale(): void
    {
        $service = new SaleService(new SaleRepository());
        $customer = Customer::factory()->create();
        $product = Product::factory()->create();
        $sale = $service->create([
            'date' => now()->toDateString(),
            'customer_id' => $customer->id,
            'products' => [
                ['product_id' => $product->id, 'quantity' => 1, 'price' => $product->price],
            ],
        ]);

        $response = $this->deleteJson("/api/sales/{$sale->id}");

        $response->assertNoContent();
        $this->assertDatabaseMissing('sales', ['id' => $sale->id]);
    }
}
