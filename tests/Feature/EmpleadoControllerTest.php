<?php

namespace Tests\Feature;

use App\Models\Empleado;
// use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;
use Faker\Factory as Faker;

class EmpleadoControllerTest extends TestCase
{
    // use RefreshDatabase;

    public function testIndex()
    {
        // Empleado::factory()->count(5)->create();

        $response = $this->get('/api/empleados');

        $response->assertStatus(200)
            ->assertJsonStructure(['ok', 'data']);
    }

    public function testStore()
    {
        $empleadoData = [
            'nombres' => 'John',
            'apellidos' => 'Doe',
            'fecha_inicio' => '2022-01-01',
            // Agrega más datos según sea necesario
        ];

        $response = $this->postJson('/api/empleados', $empleadoData);

        $response->assertStatus(201)
            ->assertJsonStructure(['ok', 'data']);
    }

    public function testShow()
    {
        
        $faker = Faker::create('es_ES'); 

        $empleado = new Empleado();
        $empleado->nombres = $faker->firstName;
        $empleado->apellidos = $faker->lastName;
        $empleado->fecha_inicio = $faker->dateTimeBetween('-20 years', '-1 year')->format('Y-m-d');
        $empleado->save();

        $response = $this->get("/api/empleados/{$empleado->id}");

        $response->assertStatus(200)
            ->assertJsonStructure(['ok', 'data']);
    }

    public function testUpdate()
    {
        // $empleado = Empleado::factory()->create();
        
        $faker = Faker::create('es_ES'); 

        $empleado = new Empleado();
        $empleado->nombres = $faker->firstName;
        $empleado->apellidos = $faker->lastName;
        $empleado->fecha_inicio = $faker->dateTimeBetween('-20 years', '-1 year')->format('Y-m-d');
        $empleado->save();

        $empleadoData = [
            'nombres' => 'Updated Name',
            'apellidos' => 'Updated Lastname',
            'fecha_inicio' => '2022-02-01',
            // Agrega más datos según sea necesario
        ];

        $response = $this->putJson("/api/empleados/{$empleado->id}", $empleadoData);

        $response->assertStatus(201)
            ->assertJsonStructure(['ok', 'data']);
    }

    public function testDestroy()
    {
        // $empleado = Empleado::factory()->create();
        
        $faker = Faker::create('es_ES'); 

        $empleado = new Empleado();
        $empleado->nombres = $faker->firstName;
        $empleado->apellidos = $faker->lastName;
        $empleado->fecha_inicio = $faker->dateTimeBetween('-20 years', '-1 year')->format('Y-m-d');
        $empleado->save();

        $response = $this->delete("/api/empleados/{$empleado->id}");

        $response->assertStatus(201)
            ->assertJsonStructure(['ok', 'data']);
    }

    // public function testEmpleadoVacaciones()
    // {
    //     // $empleado = Empleado::factory()->create();
        
    //     // $faker = Faker::create('es_ES'); 

    //     // $empleado = new Empleado();
    //     // $empleado->nombres = $faker->firstName;
    //     // $empleado->apellidos = $faker->lastName;
    //     // $empleado->fecha_inicio = $faker->dateTimeBetween('-20 years', '-1 year')->format('Y-m-d');
    //     // $empleado->save();

    //     // $response = $this->get("/api/empleados/{$empleado->id}/vacaciones");

    //     // $response->assertStatus(201)
    //     //     ->assertJsonStructure(['ok', 'data']);
    // }
}
