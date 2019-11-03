<?php

use Illuminate\Database\Seeder;

class MaintenancesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory('App\Models\Maintenance')->create([
            'name' => 'Reparación de PC escritorio Nivel I',
            'price' => 70.00
        ]);

        factory('App\Models\Maintenance')->create([
            'name' => 'Reparación de PC escritorio Nivel II',
            'price' => 149.99
        ]);

        factory('App\Models\Maintenance')->create([
            'name' => 'Reparación de PC escritorio Nivel III',
            'price' => 300.00
        ]);

        factory('App\Models\Maintenance')->create([
            'name' => 'Limpieza de PC escritorio',
            'price' => 85.00
        ]);

        factory('App\Models\Maintenance')->create([
            'name' => 'Limpieza de Laptop',
            'price' => 90.00
        ]);

        factory('App\Models\Maintenance')->create([
            'name' => 'Reparación SmartPhone Nivel I',
            'price' => 100.00
        ]);

        factory('App\Models\Maintenance')->create([
            'name' => 'Reparación SmartPhone Nivel II',
            'price' => 250.00
        ]);

        factory('App\Models\Maintenance')->create([
            'name' => 'Reparación SmartPhone Nivel III',
            'price' => 600.00
        ]);

        factory('App\Models\Maintenance')->create([
            'name' => 'Formateo Computadora',
            'price' => 99.00
        ]);

        factory('App\Models\Maintenance')->create([
            'name' => 'Formateo SmartPhone',
            'price' => 120.00
        ]);

        factory('App\Models\Maintenance')->create([
            'name' => 'Limpieza de impresora',
            'price' => 430.00
        ]);

        factory('App\Models\Maintenance')->create([
            'name' => 'Reparación de impresora',
            'price' => 560.50
        ]);
    }
}
