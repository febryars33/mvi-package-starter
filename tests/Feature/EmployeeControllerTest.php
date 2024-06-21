<?php

namespace MVI\Starter\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use MVI\Starter\Tests\TestCase;

class EmployeeControllerTest extends TestCase
{
    /**
     * Get all employee data.
     */
    public function test_get_all(): void
    {
        $response = $this->getJson('/api/starter/employees');

        $response->assertStatus(200);
    }

    /**
     * Get data with search query.
     */
    public function test_get_with_search(): void
    {
        $data = [
            'search'    =>  'Dr'
        ];

        $response = $this->getJson('/api/starter/employees?' . http_build_query($data));

        $response->assertStatus(200);
    }

    /**
     * Get row data by id.
     */
    public function test_get_row_data(): void
    {
        $response = $this->getJson('/api/starter/employees/1');

        $response->assertStatus(200);
    }

    /**
     * Get row data by id (not found).
     */
    public function test_get_row_data_not_found(): void
    {
        $response = $this->getJson('/api/starter/employees/500');

        $response->assertStatus(404);
    }

    /**
     * Get data with search query.
     */
    public function test_creating_new_employee(): void
    {
        $this->withExceptionHandling();

        $data = [
            'role_id'   =>  1,
            'name'      =>  'Foo Bar',
            'status'    =>  true,
        ];

        $response = $this->postJson('/api/starter/employees', $data);

        $response->assertStatus(201);
    }

    /**
     * Update row data by id.
     */
    public function test_update_row_data(): void
    {
        $this->withExceptionHandling();

        $data = [
            'role_id'   =>  1,
            'name'      =>  'Foo Bar',
            'status'    =>  true,
        ];

        $response = $this->putJson('/api/starter/employees/1', $data);

        $response->assertStatus(200);
    }

    /**
     * Update row data by id (not found).
     */
    public function test_update_row_data_not_found(): void
    {
        $this->withExceptionHandling();

        $data = [
            'role_id'   =>  1,
            'name'      =>  'Foo Bar',
            'status'    =>  true,
        ];

        $response = $this->putJson('/api/starter/employees/500', $data);

        $response->assertStatus(404);
    }

    /**
     * Delete row data.
     */
    public function test_delete_row_data(): void
    {
        $this->withExceptionHandling();

        $response = $this->deleteJson('/api/starter/employees/1');

        $response->assertStatus(200);
    }
}
