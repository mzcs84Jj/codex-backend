<?php

namespace Tests\Unit;

use App\Http\Requests\StoreProductRequest;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class StoreProductRequestTest extends TestCase
{
    public function test_rules_validate_data(): void
    {
        $request = new StoreProductRequest();
        $rules = $request->rules();

        $data = [
            'description' => 'Test description',
            'price' => '10.00',
        ];
        $validator = Validator::make($data, $rules);

        $this->assertTrue($validator->passes());
    }
}
