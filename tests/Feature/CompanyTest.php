<?php

namespace Tests\Feature;

use App\Models\Companies;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_not_show_create_company_form()
    {
        $response = $this->get(route('companies.create'));
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    public function test_admin_can_show_create_company_form()
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
        ]);

        $user = User::first();

        $response = $this->actingAs($user);

        $response = $this->get(route('companies.create'));
        $response->assertStatus(200);
    }


    public function test_data_is_required_to_create_company()
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
        ]);

        $user = User::first();

        $response = $this->actingAs($user);

        $response = $this->post(route('companies.store'), [
            'name' => 'Test Company',
            'email' => 'test@example.com',
            'website' => 'http://test.com',
        ]);

        $company = Companies::all()->count();

        $this->assertAuthenticated();
        $this->assertEquals(1, $company);
        $response->assertStatus(302);
        $response->assertRedirect(route('companies.index'));
    }
}
