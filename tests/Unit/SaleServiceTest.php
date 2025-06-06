<?php

namespace Tests\Unit;

use App\Models\Sale;
use App\Repositories\SaleRepository;
use App\Services\SaleService;
use Illuminate\Database\Eloquent\Collection;
use Mockery;
use PHPUnit\Framework\TestCase;

class SaleServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_all_returns_sales(): void
    {
        $repository = Mockery::mock(SaleRepository::class);
        $service = new SaleService($repository);
        $collection = new Collection([new Sale(), new Sale()]);
        $repository->shouldReceive('all')->once()->andReturn($collection);
        $this->assertSame($collection, $service->all());
    }

    public function test_create_calls_repository(): void
    {
        $repository = Mockery::mock(SaleRepository::class);
        $service = new SaleService($repository);
        $data = ['date' => '2024-01-01'];
        $sale = new Sale($data);
        $repository->shouldReceive('create')->with($data)->once()->andReturn($sale);
        $this->assertSame($sale, $service->create($data));
    }

    public function test_update_calls_repository(): void
    {
        $repository = Mockery::mock(SaleRepository::class);
        $service = new SaleService($repository);
        $sale = new Sale(['date' => '2024-01-01']);
        $data = ['date' => '2024-01-02'];
        $repository->shouldReceive('update')->with($sale, $data)->once()->andReturn($sale);
        $this->assertSame($sale, $service->update($sale, $data));
    }

    public function test_delete_calls_repository(): void
    {
        $repository = Mockery::mock(SaleRepository::class);
        $service = new SaleService($repository);
        $sale = new Sale(['date' => '2024-01-01']);
        $repository->shouldReceive('delete')->with($sale)->once();
        $service->delete($sale);
    }
}
