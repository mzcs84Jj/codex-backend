<?php

namespace App\Services;

use App\Models\Customer;
use App\Repositories\CustomerRepository;
use Illuminate\Database\Eloquent\Collection;

class CustomerService
{
    public function __construct(private CustomerRepository $repository)
    {
    }

    public function all(): Collection
    {
        return $this->repository->all();
    }

    public function create(array $data): Customer
    {
        return $this->repository->create($data);
    }

    public function update(Customer $customer, array $data): Customer
    {
        return $this->repository->update($customer, $data);
    }

    public function delete(Customer $customer): void
    {
        $this->repository->delete($customer);
    }
}
