<?php

namespace App\Repositories;

use App\Models\Sale;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class SaleRepository
{
    public function all(): Collection
    {
        return Sale::with('saleProducts')->get();
    }

    public function create(array $data): Sale
    {
        return DB::transaction(function () use ($data) {
            $products = $data['products'];
            unset($data['products']);
            $sale = Sale::create($data);
            foreach ($products as $product) {
                $sale->saleProducts()->create($product);
            }
            return $sale->load('saleProducts');
        });
    }

    public function update(Sale $sale, array $data): Sale
    {
        return DB::transaction(function () use ($sale, $data) {
            if (isset($data['date'])) {
                $sale->date = $data['date'];
            }
            if (isset($data['customer_id'])) {
                $sale->customer_id = $data['customer_id'];
            }
            $sale->save();
            if (isset($data['products'])) {
                $sale->saleProducts()->delete();
                foreach ($data['products'] as $product) {
                    $sale->saleProducts()->create($product);
                }
            }
            return $sale->load('saleProducts');
        });
    }

    public function delete(Sale $sale): void
    {
        DB::transaction(function () use ($sale) {
            $sale->saleProducts()->delete();
            $sale->delete();
        });
    }
}
