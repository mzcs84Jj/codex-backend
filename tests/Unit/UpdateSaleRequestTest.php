<?php

namespace Tests\Unit;

use App\Http\Requests\UpdateSaleRequest;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class UpdateSaleRequestTest extends TestCase
{
    public function test_rules_validate_data(): void
    {
        $request = new UpdateSaleRequest();
        $rules = $request->rules();
        $data = [
            'date' => '2024-01-02',
            'customer_id' => 1,
            'products' => [
                ['product_id' => 1, 'quantity' => 2, 'price' => '20.00'],
            ],
        ];
        $validator = Validator::make($data, $rules);
        $this->assertTrue($validator->passes());
    }
}
