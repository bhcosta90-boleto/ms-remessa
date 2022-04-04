<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataBancos = [
            [
                'uuid' => 'ca578063-42e9-426b-8b80-2cffd34a8387',
                'codigo' => '301',
                'cnpj' => '99999999999999',
                'nome' => 'PJBank',
                'agencia' => '1234',
                'conta' => '4567',
                'carteira' => '010',
                'data' => json_encode([
                    'conta_bancaria' => '156165156156',
                ])
            ],
            [
                'uuid' => 'ca578063-42e9-426b-8b80-2cffd34a8400',
                'codigo' => '033',
                'cnpj' => '99999999999999',
                'nome' => 'PJBank',
                'agencia' => '1234',
                'conta' => '4567',
                'carteira' => '010',
                'data' => null
            ]
        ];

        DB::table('bancos')->insert($dataBancos);
    }
}
