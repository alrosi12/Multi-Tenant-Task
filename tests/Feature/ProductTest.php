<?php

namespace Tests\Feature;

use App\Models\Tenant;
use App\Models\User;
use Database\Seeders\RolesAndPermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $this->seed(RolesAndPermissionsSeeder::class);
        $tenant = Tenant::factory()->create();

        $user = User::factory()->create([
            'tenant_id' => $tenant->id
        ]);

        setPermissionsTeamId($tenant->id);
        $user->assignRole('warehouse_manager');

        $response = $this->actingAs($user)
            ->postJson('/api/products', [
                'name' => 'test product',
                'price' => 55,
                'low_stock_threshold' => 10
            ]);

        $response->assertStatus(201);
    }

    public function test2_example(): void
    {
        $this->seed(RolesAndPermissionsSeeder::class);
        $tenant = Tenant::factory()->create();

        $user = User::factory()->create([
            'tenant_id' => $tenant->id
        ]);

        setPermissionsTeamId($tenant->id);
        $user->assignRole('viewer');

        $response = $this->actingAs($user)
            ->postJson('/api/products', [
                'name' => 'test product',
                'price' => 55,
                'low_stock_threshold' => 10
            ]);

        $response->assertStatus(403);
    }
}
