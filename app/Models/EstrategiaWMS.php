<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstrategiaWMS extends Model
{
    use HasFactory;

    protected $primaryKey = 'cd_estrategia_wms'; // Definindo a chave primária
    protected $fillable = ['ds_estrategia_wms', 'nr_prioridade']; // Campos preenchíveis

    // Se desejar, pode definir a tabela manualmente
    protected $table = 'tb_estrategia_wms';

     const CREATED_AT = 'dt_registro';
    const UPDATED_AT = 'dt_modificado';
}
