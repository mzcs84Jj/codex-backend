<?php

namespace App\Services;

use App\Models\Sale;
use App\Repositories\SaleRepository;
use Illuminate\Database\Eloquent\Collection;

class SaleService
{
    public function __construct(private SaleRepository $repository)
    {
    }

    public function all(): Collection
    {
        return $this->repository->all();
    }

    public function create(array $data): Sale
    {
        return $this->repository->create($data);
    }

    public function update(Sale $sale, array $data): Sale
    {
        return $this->repository->update($sale, $data);
    }

    public function delete(Sale $sale): void
    {
        $this->repository->delete($sale);
    }
}
