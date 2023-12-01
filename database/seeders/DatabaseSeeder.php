<?php

namespace Database\Seeders;

use App\Models\Empleado;
use App\Models\Anio;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'user' => 'daniel',
            'password' => Hash::make('daniel'),
            'nombres' => 'daniel',
            'apellidos' => 'delgado camacho',
        ]);

        // for ($i=0; $i < 100; $i++) { 
        //     \App\Models\User::factory()->create([
        //         'name' => $faker->firstName,
        //         'email' => $faker->unique()->safeEmail,
        //         'user' => $faker->userName,
        //         'password' => Hash::make( $faker->userName),
        //         'nombres' =>  $faker->firstName,
        //         'apellidos' =>  $faker->lastName,
        //     ]);
        // }
        
        // $user = new User();
        // $user->nombres = 'Juan';
        // $user->apellidos = 'Fernandez';
        // $user->admin = '1';
        // $user->control = '0';
        // $user->email = 'admin@gmail.com';
        // $user->user = 'admin';
        // $user->email_verified_at = now();
        // $user->activo = true;
        // $user->password = Hash::make('admin');
        // $user->remember_token = Str::random(10);
        // $user->save();

        // \App\Models\Zona::factory()->create([
        //     'nombre' => 'Otro'
        // ]);
        // \App\Models\Zona::factory()->create([
        //     'nombre' => 'Quillacollo'
        // ]);
        // \App\Models\Zona::factory()->create([
        //     'nombre' => 'Zofraco'
        // ]);

        
        // \App\Models\PlanInternet::factory()->create([
        //     'nombre' => 'Fibra10Mb/s',
        //     'precio' => '100'
        // ]);
        // \App\Models\PlanInternet::factory()->create([
        //     'nombre' => 'Mantenimiento',
        //     'precio' => '0'
        // ]);

        for ($i=2000; $i < 2023; $i++) {
            \App\Models\Anio::factory()->create([
                'nombre' => (string)$i,
                'activo' => false,
            ]);
        }
        \App\Models\Anio::factory()->create([
            'nombre' => '2023',
            'activo' => true,
        ]);

        // \App\Models\Empleado::factory()->create([
        //     'nombres' => 'daniel',
        //     'apellidos' => 'delgado camacho',
        //     'fecha_inicio' => '1999-10-19',
        // ]);

        $fechaFin = Carbon::parse('2023-12-01');
        $faker = Faker::create('es_ES'); 
        for ($i=0; $i < 5; $i++) {
            $obj = new Empleado();
            $obj->nombres = $faker->firstName;
            $obj->apellidos = $faker->lastName;
            $obj->fecha_inicio = $faker->dateTimeBetween('-20 years', '-1 year')->format('Y-m-d');
            $obj->save();
            
            $fechaInicio = Carbon::parse($obj->fecha_inicio);
            $anios = [];
            for ($anio = $fechaInicio->year; $anio <= $fechaFin->year; $anio++) {
                $anios[] = $anio;
            }
            
            for ($j=0; $j < count($anios); $j++) { 
                $anio = Anio::where('nombre', (string)$anios[$j])->first();
                if ((string)$anios[$j] == '2023') {
                    $dias_vacaciones = 0;
                    if (count($anios) <= 5) {
                        $dias_vacaciones = 15;
                    }else{
                        if (count($anios) <= 10) {
                            $dias_vacaciones = 20;
                        }else{
                            if (count($anios) > 10) {
                                $dias_vacaciones = 30;
                            }else{
                                $dias_vacaciones = 0;
                            }
                        }
                    }
                    \App\Models\Vacacion::factory()->create([
                        'dias_restantes' => $dias_vacaciones,
                        'dias_vacaciones' => $dias_vacaciones,
                        'activo' => true,
                        'empleado_id' => $obj->id,
                        'anio_id' => $anio->id,
                    ]);
                }else{
                    \App\Models\Vacacion::factory()->create([
                        'dias_restantes' => 0,
                        'dias_vacaciones' => 0,
                        'activo' => false,
                        'empleado_id' => $obj->id,
                        'anio_id' => $anio->id,
                    ]);
                }
            }
        }
        
        \App\Models\DiaLaboral::factory()->create([
            'Domingo' => false,
            'Lunes' => true,
            'Martes' => true,
            'Miercoles' => true,
            'Jueves' => true,
            'Viernes' => true,
            'Sabado' => false,
        ]);
    }
}
