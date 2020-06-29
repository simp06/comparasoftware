<?php

use Illuminate\Database\Seeder;
use App\Models\Funcionalidad;
class FuncionalidadTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $data = [
            [
                'id'             => 1,
                'nombre'           => 'Acceso móvil',
                'created_at'     => '2019-09-28 14:22:15',
                'updated_at'     => '2019-09-28 14:22:15',
            ],
            [
                'id'             => 2,
                'nombre'           => 'Mantenimiento Preventivo',
                'created_at'     => '2019-09-28 14:22:15',
                'updated_at'     => '2019-09-28 14:22:15',
            ],
            [
                'id'             => 3,
                'nombre'           => 'Mantenimiento Predictivo',
                'created_at'     => '2019-09-28 14:22:15',
                'updated_at'     => '2019-09-28 14:22:15',
            ],
            [
                'id'             => 4,
                'nombre'           => 'Gestión en terreno',
                'created_at'     => '2019-09-28 14:22:15',
                'updated_at'     => '2019-09-28 14:22:15',
            ],
        ];

        Funcionalidad::insert($data);
    }
}
