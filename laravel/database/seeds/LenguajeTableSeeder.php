<?php
use App\Models\Lenguaje;
use Illuminate\Database\Seeder;

class LenguajeTableSeeder extends Seeder
{
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
                'nombre'           => 'Español',
                'created_at'     => '2019-09-28 14:22:15',
                'updated_at'     => '2019-09-28 14:22:15',
            ],
            [
                'id'             => 2,
                'nombre'           => 'Ingles',
                'created_at'     => '2019-09-28 14:22:15',
                'updated_at'     => '2019-09-28 14:22:15',
            ],
            [
                'id'             => 3,
                'nombre'           => 'Portugues',
                'created_at'     => '2019-09-28 14:22:15',
                'updated_at'     => '2019-09-28 14:22:15',
            ],
        ];

        Lenguaje::insert($data);
    }
}
