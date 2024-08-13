<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('tb_estrategia_wms_horario_prioridade', function (Blueprint $table) {
            $table->bigIncrements('cd_estrategia_wms_horario_prioridade'); // Nome da coluna primária
            $table->foreignId('cd_estrategia_wms') // Chave estrangeira
                  ->constrained('tb_estrategia_wms', 'cd_estrategia_wms') // Tabela e coluna referenciada
                  ->onDelete('cascade');
            $table->time('ds_horario_inicio');
            $table->time('ds_horario_final');
            $table->integer('nr_prioridade');
            $table->timestamp('dt_registro')->useCurrent();
            $table->timestamp('dt_modificado')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_estrategia_wms_horario_prioridade');
    }
};

