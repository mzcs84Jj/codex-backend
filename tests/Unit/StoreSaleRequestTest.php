<?php

namespace Tests\Unit;

use App\Http\Requests\StoreSaleRequest;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class StoreSaleRequestTest extends TestCase
{
    public function test_rules_validate_data(): void
    {
        $request = new StoreSaleRequest();
        $rules = $request->rules();
        $data = [
            'date' => '2024-01-01',
            'customer_id' => 1,
            'products' => [
                ['product_id' => 1, 'quantity' => 1, 'price' => '10.00'],
            ],
        ];
        $validator = Validator::make($data, $rules);
        $this->assertTrue($validator->passes());
    }
}
