<?php

namespace Tests\Unit;

use App\Models\Customer;
use App\Repositories\CustomerRepository;
use App\Services\CustomerService;
use Illuminate\Database\Eloquent\Collection;
use Mockery;
use PHPUnit\Framework\TestCase;

class CustomerServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();

        parent::tearDown();
    }

    public function test_all_returns_customers(): void
    {
        $repository = Mockery::mock(CustomerRepository::class);
        $service = new CustomerService($repository);
        $collection = new Collection([new Customer(), new Customer()]);

        $repository->shouldReceive('all')->once()->andReturn($collection);

        $this->assertSame($collection, $service->all());
    }

    public function test_create_calls_repository(): void
    {
        $repository = Mockery::mock(CustomerRepository::class);
        $service = new CustomerService($repository);
        $data = ['name' => 'Test', 'email' => 'test@example.com'];
        $customer = new Customer($data);

        $repository->shouldReceive('create')->with($data)->once()->andReturn($customer);

        $this->assertSame($customer, $service->create($data));
    }

    public function test_update_calls_repository(): void
    {
        $repository = Mockery::mock(CustomerRepository::class);
        $service = new CustomerService($repository);
        $customer = new Customer(['name' => 'Old', 'email' => 'old@example.com']);
        $data = ['name' => 'New', 'email' => 'new@example.com'];

        $repository->shouldReceive('update')->with($customer, $data)->once()->andReturn($customer);

        $this->assertSame($customer, $service->update($customer, $data));
    }

    public function test_delete_calls_repository(): void
    {
        $repository = Mockery::mock(CustomerRepository::class);
        $service = new CustomerService($repository);
        $customer = new Customer(['name' => 'Delete', 'email' => 'd@example.com']);

        $repository->shouldReceive('delete')->with($customer)->once();

        $service->delete($customer);
    }
}
