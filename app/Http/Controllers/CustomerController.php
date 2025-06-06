<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use App\Services\CustomerService;
use Illuminate\Http\JsonResponse;

class CustomerController extends Controller
{
    public function __construct(private CustomerService $service)
    {
    }

    public function index(): JsonResponse
    {
        return response()->json($this->service->all());
    }

    public function store(StoreCustomerRequest $request): JsonResponse
    {
        $customer = $this->service->create($request->validated());

        return response()->json($customer, 201);
    }

    public function show(Customer $customer): JsonResponse
    {
        return response()->json($customer);
    }

    public function update(UpdateCustomerRequest $request, Customer $customer): JsonResponse
    {
        $customer = $this->service->update($customer, $request->validated());

        return response()->json($customer);
    }

    public function destroy(Customer $customer): JsonResponse
    {
        $this->service->delete($customer);

        return response()->json([], 204);
    }
}
