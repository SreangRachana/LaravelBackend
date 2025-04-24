<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    public function test_if_we_can_create_product()
    {
        $category = Category::create(['name' => 'Books']);

        $response = $this->postJson('/api/products', [
            'name' => 'Laravel Guide',
            'category_id' => $category->id,
            'pricing' => 25.00,
            'description' => 'A beginner-friendly Laravel guide.',
        ]);

        $response->assertStatus(200)
                ->assertJsonFragment(['message' => 'Laravel Guidehas been added.']);
    }

    public function test_if_we_can_access_get_product_by_id()
    {
        $category = Category::create(['name' => 'Toys']);
        $product = Product::create([
            'name' => 'Lego Set',
            'category_id' => $category->id,
            'pricing' => 49.99,
            'description' => 'Colorful bricks',
        ]);

        $response = $this->getJson("/api/products/{$product->id}");

        $response->assertStatus(200)
                ->assertJsonFragment(['name' => 'Lego Set']);
    }

    public function test_if_we_can_update_product()
{
    $category = Category::create(['name' => 'Games']);
    $product = Product::create([
        'name' => 'Chess Set',
        'category_id' => $category->id,
        'pricing' => 15.00,
        'description' => 'Classic board game',
    ]);

    $response = $this->patchJson("/api/products/{$product->id}", [
        'name' => 'Premium Chess Set',
        'category_id' => $category->id,
        'pricing' => 35.00,
        'description' => 'Wooden board and pieces',
    ]);

    $response->assertStatus(200)
             ->assertJsonFragment(['message' => 'Product Updated!!!']); // Assert against the success message

    // If you want to also verify the updated data in a separate request:
    $this->getJson("/api/products/{$product->id}")
        ->assertStatus(200)
        ->assertJsonFragment(['name' => 'Premium Chess Set', 'pricing' => 35.00]);
}

    public function test_if_we_can_delete_product()
    {
        $category = Category::create(['name' => 'Fashion']);
        $product = Product::create([
            'name' => 'T-Shirt',
            'category_id' => $category->id,
            'pricing' => 10.00,
            'description' => 'Comfortable cotton tee',
        ]);

        $response = $this->deleteJson("/api/products/{$product->id}");

        $response->assertStatus(200)
                ->assertJsonFragment(['message' => 'Product Deleted!!!']);
    }

    public function test_if_we_can_access_get_products_by_category()
    {
        $category = Category::create(['name' => 'Accessories']);
        Product::create([
            'name' => 'Watch',
            'category_id' => $category->id,
            'pricing' => 99.99,
            'description' => 'Smart watch with features',
        ]);

        $response = $this->getJson("/api/products/category/{$category->id}"); // Keep this if your route is as in api.php

        $response->assertStatus(200)
                ->assertJsonFragment(['name' => 'Watch']);
    }
}
