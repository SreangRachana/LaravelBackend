<?php

namespace Tests\Feature;

use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Category;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test ID: Category--001
     * Description: Check if we can access the get all categories API
     * Precondition: None
     * Test Steps:   1. Hit the get all categories API
     *               2. Check if the response status is 200
     * Test Data : None
     * Expected Result: The response status should be 200
     * Actual result: The response status is 200
     * Status: Passed
     * Remark: None
     */
    public function test_if_we_can_access_get_all_categories_api(): void
    {
        $response = $this->get('/api/categories');

        $response->assertStatus(200)->assertJsonFragment(['message' => 'success']);
    }

    /**
     * Test ID: Category--002
     * Description: Check if we can access the create category API
     * Precondition: None
     * Test Steps:   1. Generate a random "name"
     *               2. Hit the create category API
     *               3. Check if the response status is 200
     * Test Data : None
     * Expected Result: The response status should be 200
     * Actual result: The response status is 200
     * Status: Passed
     * Remark: None
     */
    public function test_if_we_can_create_category(): void
    {
        $name = Factory::create()->company();
        $response = $this->post('/api/categories', ['name' => $name]);

        $response->assertStatus(200)->assertJsonFragment(['message' => $name . ' has been added.']);
    }

    /**
     * Test ID: Category--003
     * Description: Check if we can access the get category by ID API
     * Precondition: A category ID must exist in the database
     * Test Steps:   1. Create a test category in the database
     *               2. Call the get category by ID endpoint with the test category's ID
     *               3. Check if the response status is 200
     * Test Data : Auto-generated using factory (Faker)
     * Expected Result: The response should return status 200
     * Actual result: The response status is 200
     * Status: Passed
     * Remark: None
     */
    public function test_if_we_can_access_get_category_by_id_api(): void
    {
        $category = Category::create(['name' => fake()->company()]);

        $response = $this->get("/api/categories/{$category->id}");

        $response->assertStatus(200)
                ->assertJson([
                    'category' => [
                        'id' => $category->id,
                        'name' => $category->name,
                    ],
                    'message' => 'success',
                ]);
    }

    /**
     * Test ID: Category--004
     * Description: Verify that we can successfully update an existing category
     * Precondition: A category must already exist in the database
     * Test Steps:   1. Create a category with an initial name
     *               2. Send a PUT request to update the category's name
     *               3. Check if the response status is 200
     * Test Data : Initial name: "Old Name", Updated name: "Updated Name"
     * Expected Result: The category name should be updated in the database
     * Actual result: The response status is 200
     * Status: Passed
     * Remark: None
     */
    public function test_if_we_can_update_category(): void
    {
        $category = Category::create(['name' => 'Old Name']);

        $updatedName = 'Updated Name';
        $response = $this->patch("/api/categories/{$category->id}", ['name' => $updatedName]);
        $response->assertStatus(200)->assertJsonFragment(['message' => 'Category Updated!!!']);
        $this->assertDatabaseHas('categories', ['id' => $category->id, 'name' => $updatedName]);
    }

    /**
     * Test ID: Category--005
     * Description: Ensure we can delete a category using its ID
     * Precondition: A category must exist in the database to delete
     * Test Steps:   1. Create a category in the database
     *               2. Send a DELETE request to the category delete endpoint
     *               3. Check if the response status is 200
     * Test Data : Auto-generated category with name "To Be Deleted"
     * Expected Result: The category should be removed from the database
     * Actual result: The response status is 200
     * Status: Passed
     * Remark: None
     */
    public function test_if_we_can_delete_category(): void
    {

        $category = Category::create(['name' => 'To Be Deleted']);

        $response = $this->delete("/api/categories/{$category->id}");
        $response->assertStatus(200)->assertJsonFragment(['message' => 'Category Deleted!!!']);
        $this->assertDatabaseHas('categories', ['id' => $category->id]);
        $this->assertNotNull(Category::withTrashed()->find($category->id)->deleted_at);
    }

    /**
     * Test ID: Category--006
     * Description: Check if we can access all products for a specific category
     * Precondition: None
     * Test Steps:   1. Hit the get products by category API
     *               2. Check if the response status is 200
     * Test Data : None
     * Expected Result: The response status should be 200
     * Actual result: The response status is 200
     * Status: Passed
     * Remark: None
     */
    public function test_if_we_can_access_find_products_by_category()
    {
        $this->get('/api/categories/1/products')->assertStatus(200);
    }

    /**
     * Test ID: Category--007
     * Description: Check if we can access a limited number of categories
     * Precondition: None
     * Test Steps:   1. Hit the get limited categories API
     *               2. Check if the response status is 200
     * Test Data : None
     * Expected Result: The response status should be 200
     * Actual result: The response status is 200
     * Status: Passed
     * Remark: None
     */
    public function test_it_we_can_access_get_limited_categories()
    {
        $this->get('/api/categories/limited_category/10')->assertStatus(200);
    }

}
