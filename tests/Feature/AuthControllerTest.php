<?php

namespace Tests\Feature;

use App\Http\Controllers\AuthController;
// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    // use RefreshDatabase;

    public function testIndex()
    {
        // Puedes realizar una solicitud GET a la ruta 'usuarios'
        $response = $this->get('/api/usuarios');

        // Asegúrate de que la solicitud se haya realizado correctamente (código de estado 200)
        $response->assertStatus(200);

        // Puedes agregar más afirmaciones según sea necesario
    }

    public function testShow()
    {
        // Puedes realizar una solicitud GET a un usuario específico, por ejemplo, 'api/usuarios/1'
        $response = $this->get('/api/usuarios/1');

        // Asegúrate de que la solicitud se haya realizado correctamente (código de estado 200)
        $response->assertStatus(200);

        // Puedes agregar más afirmaciones según sea necesario
    }

    
    // Agrega más métodos de prueba para otros métodos en AuthController (store, update, destroy, etc.)
}
