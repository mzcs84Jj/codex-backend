<?php

namespace Tests\Unit;

use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class StoreProductRequestTest extends TestCase
{
    public function test_rules_validate_data(): void
    {
        $request = new StoreProductRequest();
        $rules = $request->rules();

        $data = Product::factory()->make()->toArray();
        $validator = Validator::make($data, $rules);

        $this->assertTrue($validator->passes());
    }
}
