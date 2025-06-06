<?php

namespace Tests\Unit;

use App\Http\Requests\UpdateCustomerRequest;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class UpdateCustomerRequestTest extends TestCase
{
    public function test_rules_validate_data(): void
    {
        $request = new UpdateCustomerRequest();
        $rules = $request->rules();

        $data = [
            'name' => 'Updated',
            'email' => 'u@example.com',
        ];
        $validator = Validator::make($data, $rules);

        $this->assertTrue($validator->passes());
    }
}
