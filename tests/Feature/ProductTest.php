<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_products(): void
    {
        Product::factory()->count(2)->create();

        $response = $this->getJson('/api/products');

        $response->assertOk()->assertJsonCount(2);
    }

    public function test_store_creates_product(): void
    {
        $data = Product::factory()->make()->toArray();

        $response = $this->postJson('/api/products', $data);

        $response->assertCreated()->assertJsonFragment(['description' => $data['description']]);
        $this->assertDatabaseHas('products', ['description' => $data['description']]);
    }

    public function test_show_returns_product(): void
    {
        $product = Product::factory()->create();

        $response = $this->getJson("/api/products/{$product->id}");

        $response->assertOk()->assertJson(['id' => $product->id, 'description' => $product->description]);
    }

    public function test_update_modifies_product(): void
    {
        $product = Product::factory()->create();
        $data = Product::factory()->make()->toArray();

        $response = $this->putJson("/api/products/{$product->id}", $data);

        $response->assertOk()->assertJsonFragment(['description' => $data['description']]);
        $this->assertDatabaseHas('products', ['id' => $product->id, 'description' => $data['description']]);
    }

    public function test_destroy_deletes_product(): void
    {
        $product = Product::factory()->create();

        $response = $this->deleteJson("/api/products/{$product->id}");

        $response->assertNoContent();
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}
