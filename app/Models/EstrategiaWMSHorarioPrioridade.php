<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstrategiaWMSHorarioPrioridade extends Model
{
    use HasFactory;

    protected $primaryKey = 'cd_estrategia_wms_horario_prioridade'; // Definindo a chave primária
    protected $fillable = ['cd_estrategia_wms', 'ds_horario_inicio', 'ds_horario_final', 'nr_prioridade']; // Campos preenchíveis

    // Se desejar, pode definir a tabela manualmente
    protected $table = 'tb_estrategia_wms_horario_prioridade';

    const CREATED_AT = 'dt_registro';
    const UPDATED_AT = 'dt_modificado';
}
