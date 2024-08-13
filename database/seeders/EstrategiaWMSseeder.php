<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstrategiaWMSseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          DB::table('tb_estrategia_wms')->insert([
            [
                'ds_estrategia_wms' => 'RETIRA',
                'nr_prioridade' => 10,
                'dt_registro' => now(),
                'dt_modificado' => now(),
            ],
            [
                'ds_estrategia_wms' => 'ENTREGA',
                'nr_prioridade' => 20,
                'dt_registro' => now(),
                'dt_modificado' => now(),
            ],
            [
                'ds_estrategia_wms' => 'EXPRESSA',
                'nr_prioridade' => 30,
                'dt_registro' => now(),
                'dt_modificado' => now(),
            ],
        ]);

        DB::table('tb_estrategia_wms_horario_prioridade')->insert([
            [
                'cd_estrategia_wms' => 1, // Refere-se à estratégia 'RETIRA'
                'ds_horario_inicio' => '09:00',
                'ds_horario_final' => '10:00',
                'nr_prioridade' => 40,
            ],
            [
                'cd_estrategia_wms' => 1, // Refere-se à estratégia 'RETIRA'
                'ds_horario_inicio' => '10:01',
                'ds_horario_final' => '11:00',
                'nr_prioridade' => 30,
            ],
            [
                'cd_estrategia_wms' => 1, // Refere-se à estratégia 'RETIRA'
                'ds_horario_inicio' => '11:01',
                'ds_horario_final' => '12:00',
                'nr_prioridade' => 20,
            ],
            
        ]);
    }
}
