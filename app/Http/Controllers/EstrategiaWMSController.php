<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EstrategiaWMS;
use App\Models\EstrategiaWMSHorarioPrioridade;

class EstrategiaWMSController extends Controller
{
    // Função para criar uma nova estratégia WMS
    public function store(Request $request)
    {
        $data = $request->validate([
            'dsEstrategia' => 'required|string|max:255',
            'nrPrioridade' => 'required|integer',
            'horarios' => 'required|array',
            'horarios.*.dsHorarioInicio' => 'required|string',
            'horarios.*.dsHorarioFinal' => 'required|string',
            'horarios.*.nrPrioridade' => 'required|integer',
        ]);

        $estrategia = EstrategiaWMS::create([
            'ds_estrategia_wms' => $data['dsEstrategia'],
            'nr_prioridade' => $data['nrPrioridade'],
            'dt_registro' => now(),
            'dt_modificado' => now(),
        ]);

        foreach ($data['horarios'] as $horario) {
            EstrategiaWMSHorarioPrioridade::create([
                'cd_estrategia_wms' => $estrategia->cd_estrategia_wms,
                'ds_horario_inicio' => $horario['dsHorarioInicio'],
                'ds_horario_final' => $horario['dsHorarioFinal'],
                'nr_prioridade' => $horario['nrPrioridade'],
                'dt_registro' => now(),
                'dt_modificado' => now(),
            ]);
        }

        return response()->json($estrategia, 201);
    }

    // Função para buscar a prioridade de uma estratégia com base em hora e minuto
    public function getPrioridade($cdEstrategia, $dsHora, $dsMinuto)
    {
        $time = $dsHora . ':' . $dsMinuto;

        $prioridade = EstrategiaWMSHorarioPrioridade::where('cd_estrategia_wms', $cdEstrategia)
            ->where('ds_horario_inicio', '<=', $time)
            ->where('ds_horario_final', '>=', $time)
            ->orderBy('nr_prioridade', 'desc')
            ->first();

        if ($prioridade) {
            return response()->json(['nrPrioridade' => $prioridade->nr_prioridade]);
        }

        return response()->json(['message' => 'Horário fora dos definidos'], 404);
    }

    // Função para buscar todas as estratégias com um nível de prioridade específico
    public function getByPrioridade($nrPrioridade)
    {
        $estrategias = EstrategiaWMS::where('nr_prioridade', $nrPrioridade)->get();

        return response()->json($estrategias);
    }

    // Função para retornar todas as estratégias cadastradas
    public function getAll()
    {
        $estrategias = EstrategiaWMS::all();
        
        return response()->json($estrategias);
    }

      // Função para atualizar uma estratégia WMS existente
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'dsEstrategia' => 'sometimes|string|max:255',
            'nrPrioridade' => 'sometimes|integer',
            'horarios' => 'sometimes|array',
            'horarios.*.dsHorarioInicio' => 'sometimes|string',
            'horarios.*.dsHorarioFinal' => 'sometimes|string',
            'horarios.*.nrPrioridade' => 'sometimes|integer',
        ]);

        $estrategia = EstrategiaWMS::find($id);

        if (!$estrategia) {
            return response()->json(['message' => 'Estratégia não encontrada'], 404);
        }

        $estrategia->update([
            'ds_estrategia_wms' => $data['dsEstrategia'] ?? $estrategia->ds_estrategia_wms,
            'nr_prioridade' => $data['nrPrioridade'] ?? $estrategia->nr_prioridade,
            'dt_modificado' => now(),
        ]);

        // Atualiza horários, removendo os antigos e adicionando os novos
        if (isset($data['horarios'])) {
            EstrategiaWMSHorarioPrioridade::where('cd_estrategia_wms', $id)->delete();

            foreach ($data['horarios'] as $horario) {
                EstrategiaWMSHorarioPrioridade::create([
                    'cd_estrategia_wms' => $estrategia->cd_estrategia_wms,
                    'ds_horario_inicio' => $horario['dsHorarioInicio'],
                    'ds_horario_final' => $horario['dsHorarioFinal'],
                    'nr_prioridade' => $horario['nrPrioridade'],
                    'dt_registro' => now(),
                    'dt_modificado' => now(),
                ]);
            }
        }

        return response()->json($estrategia);
    }

    // Função para deletar uma estratégia WMS existente
    public function destroy($id)
    {
        $estrategia = EstrategiaWMS::find($id);

        if (!$estrategia) {
            return response()->json(['message' => 'Estratégia não encontrada'], 404);
        }

        EstrategiaWMSHorarioPrioridade::where('cd_estrategia_wms', $id)->delete();
        $estrategia->delete();

        return response()->json(['message' => 'Estratégia deletada com sucesso']);
    }
}
