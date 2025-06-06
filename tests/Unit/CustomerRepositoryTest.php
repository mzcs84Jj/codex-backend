<?php

namespace Tests\Unit;

use App\Models\Customer;
use App\Repositories\CustomerRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_all_returns_all_customers(): void
    {
        foreach (range(1, 3) as $i) {
            Customer::create(['name' => "Customer $i", 'email' => "c$i@example.com"]);
        }

        $repository = new CustomerRepository();
        $result = $repository->all();

        $this->assertCount(3, $result);
    }

    public function test_create_stores_customer(): void
    {
        $data = ['name' => 'Create customer', 'email' => 'create@example.com'];

        $repository = new CustomerRepository();
        $customer = $repository->create($data);

        $this->assertDatabaseHas('customers', ['id' => $customer->id]);
    }

    public function test_update_modifies_customer(): void
    {
        $customer = Customer::create(['name' => 'Old', 'email' => 'old@example.com']);
        $data = ['name' => 'Updated', 'email' => 'updated@example.com'];

        $repository = new CustomerRepository();
        $repository->update($customer, $data);

        $this->assertDatabaseHas('customers', ['id' => $customer->id, 'name' => $data['name']]);
    }

    public function test_delete_removes_customer(): void
    {
        $customer = Customer::create(['name' => 'Delete', 'email' => 'del@example.com']);

        $repository = new CustomerRepository();
        $repository->delete($customer);

        $this->assertDatabaseMissing('customers', ['id' => $customer->id]);
    }
}
