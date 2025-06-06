<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;
use App\Models\Sale;
use App\Services\SaleService;
use Illuminate\Http\JsonResponse;

class SaleController extends Controller
{
    public function __construct(private SaleService $service)
    {
    }

    public function index(): JsonResponse
    {
        return response()->json($this->service->all());
    }

    public function store(StoreSaleRequest $request): JsonResponse
    {
        $sale = $this->service->create($request->validated());

        return response()->json($sale, 201);
    }

    public function show(Sale $sale): JsonResponse
    {
        return response()->json($sale->load('saleProducts'));
    }

    public function update(UpdateSaleRequest $request, Sale $sale): JsonResponse
    {
        $sale = $this->service->update($sale, $request->validated());

        return response()->json($sale);
    }

    public function destroy(Sale $sale): JsonResponse
    {
        $this->service->delete($sale);

        return response()->json([], 204);
    }
}
