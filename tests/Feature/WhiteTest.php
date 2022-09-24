<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Buku;
use App\Models\User;


class WhiteTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        // $response = $this->get('/anggota');

        // $response->assertStatus(200);
        $this->assertTrue(true);
    
    }
    public function test_render_home_page()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_render_buku_page()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user);
        $response->get('/buku')
        ->assertSeeText('DATA BUKU')
        ->assertSeeText('ID Buku')
        ->assertSeeText('Judul')
        ->assertSeeText('Penerbit')
        ->assertSeeText('Pengarang')
        ->assertSeeText('Jenis')
        ->assertSeeText('Stok')
        ->assertSeeText('Action')
        ->assertStatus(200);
    }

    public function test_store_buku()
    {
        Buku::create([
            'judul' => 'apalah',
            'penerbit' => 'clover',
            'pengarang' => 'sujiwo tejo',
            'jenis' => 'buku',
            'stok' => 1,
        ]);

        $user = User::factory()->create();
        
        $response = $this->actingAs($user)->get('/buku');
        $response->assertStatus(200);
    }
}
