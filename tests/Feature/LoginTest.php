<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Jalankan migrasi pada database pengujian
        $this->artisan('migrate');
        
        // Tambahkan pengguna untuk pengujian
        User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'), // Sesuaikan dengan password yang diharapkan
        ]);
    }

    public function test_user_can_view_login_page()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('Login'); // Memastikan bahwa halaman login bisa diakses
    }

    public function test_user_can_login_with_correct_credentials()
    {
        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password', // Sesuaikan dengan password pengguna
        ]);

        $response->assertRedirect('/home'); // Pastikan diarahkan ke dashboard setelah login
        $this->assertAuthenticated(); // Pastikan pengguna sudah terautentikasi
    }

    public function test_user_cannot_login_with_incorrect_credentials()
    {
        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'wrongpassword', // Password salah
        ]);

        $response->assertSessionHasErrors('email'); // Pastikan error untuk kolom email
        $this->assertGuest(); // Pastikan pengguna tetap tidak terautentikasi
    }
}
