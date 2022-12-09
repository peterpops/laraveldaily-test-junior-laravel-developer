<?php

namespace Tests\Feature;

use App\Models\Employees;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class employeeTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_not_show_create_employee_form()
    {
        $response = $this->get(route('employees.create'));
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    public function test_admin_can_show_create_employee_form()
    {
        User::create([
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('password'),
            ]);

        $user = User::first();

        $response = $this->actingAs($user);

        $response = $this->get(route('employees.create'));
        $response->assertStatus(200);
    }

    public function test_data_is_required_to_create_employee() {
        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
        ]);

        $user = User::first();

        $response = $this->actingAs($user);

        $response = $this->post(route('employees.store'), [
            'firstName' => 'first',
            'lastName' => 'last',
            'email' => 'first@last.com',
            'phone' => '1234',
            'company' => '1',
        ]);

        $employee = Employees::all()->count();

        $this->assertEquals(1, $employee);
        $response->assertStatus(302);
        $response->assertRedirect(route('employees.index'));
    }
}
