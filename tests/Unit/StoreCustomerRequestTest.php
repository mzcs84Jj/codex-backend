<?php

namespace Tests\Unit;

use App\Http\Requests\StoreCustomerRequest;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class StoreCustomerRequestTest extends TestCase
{
    public function test_rules_validate_data(): void
    {
        $request = new StoreCustomerRequest();
        $rules = $request->rules();

        $data = [
            'name' => 'Customer',
            'email' => 'c@example.com',
        ];
        $validator = Validator::make($data, $rules);

        $this->assertTrue($validator->passes());
    }
}
