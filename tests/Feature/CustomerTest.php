<?php

namespace Tests\Feature;

use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_customers(): void
    {
        Customer::factory()->count(2)->create();

        $response = $this->getJson('/api/customers');

        $response->assertOk()->assertJsonCount(2);
    }

    public function test_store_creates_customer(): void
    {
        $data = Customer::factory()->make()->toArray();

        $response = $this->postJson('/api/customers', $data);

        $response->assertCreated()->assertJsonFragment(['name' => $data['name']]);
        $this->assertDatabaseHas('customers', ['name' => $data['name']]);
    }

    public function test_show_returns_customer(): void
    {
        $customer = Customer::factory()->create();

        $response = $this->getJson("/api/customers/{$customer->id}");

        $response->assertOk()->assertJson(['id' => $customer->id, 'name' => $customer->name]);
    }

    public function test_update_modifies_customer(): void
    {
        $customer = Customer::factory()->create();
        $data = Customer::factory()->make()->toArray();

        $response = $this->putJson("/api/customers/{$customer->id}", $data);

        $response->assertOk()->assertJsonFragment(['name' => $data['name']]);
        $this->assertDatabaseHas('customers', ['id' => $customer->id, 'name' => $data['name']]);
    }

    public function test_destroy_deletes_customer(): void
    {
        $customer = Customer::factory()->create();

        $response = $this->deleteJson("/api/customers/{$customer->id}");

        $response->assertNoContent();
        $this->assertDatabaseMissing('customers', ['id' => $customer->id]);
    }
}
