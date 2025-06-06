<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Repositories\ProductRepository;
use App\Services\ProductService;
use Illuminate\Database\Eloquent\Collection;
use Mockery;
use PHPUnit\Framework\TestCase;

class ProductServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();

        parent::tearDown();
    }

    public function test_all_returns_products(): void
    {
        $repository = Mockery::mock(ProductRepository::class);
        $service = new ProductService($repository);
        $collection = new Collection([new Product(), new Product()]);

        $repository->shouldReceive('all')->once()->andReturn($collection);

        $this->assertSame($collection, $service->all());
    }

    public function test_create_calls_repository(): void
    {
        $repository = Mockery::mock(ProductRepository::class);
        $service = new ProductService($repository);
        $data = ['description' => 'Test', 'price' => 10];
        $product = new Product($data);

        $repository->shouldReceive('create')->with($data)->once()->andReturn($product);

        $this->assertSame($product, $service->create($data));
    }

    public function test_update_calls_repository(): void
    {
        $repository = Mockery::mock(ProductRepository::class);
        $service = new ProductService($repository);
        $product = new Product(['description' => 'Old', 'price' => 10]);
        $data = ['description' => 'New', 'price' => 20];

        $repository->shouldReceive('update')->with($product, $data)->once()->andReturn($product);

        $this->assertSame($product, $service->update($product, $data));
    }

    public function test_delete_calls_repository(): void
    {
        $repository = Mockery::mock(ProductRepository::class);
        $service = new ProductService($repository);
        $product = new Product(['description' => 'Delete', 'price' => 5]);

        $repository->shouldReceive('delete')->with($product)->once();

        $service->delete($product);
    }
}
