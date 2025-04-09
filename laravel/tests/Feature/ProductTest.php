<?php

namespace Tests\Feature;

use Faker\Factory;
use App\Models\Product;
use App\Models\Category;
use Faker\Factory as FakerFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test ID : Product--001
     * Description: Check if we can access the get all products API
     * Precondition: None
     * Test Steps: 1. Hit the get all products
     *             2. Check if the response status is 200
     * Test Data : None
     * Expected Result: The response status should be 200
     * Actual result: The response status is 200
     * Status: Passed
     * Remark: None
     */
    public function test_if_we_can_get_all_products(): void
    {
        $response = $this->get('/api/products');

        $response->assertStatus(200)->assertJsonFragment(['message' => 'success']);
    }
}
