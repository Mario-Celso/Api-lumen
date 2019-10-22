<?php


namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Equipment;


class EquipmentController extends Controller
{
    public function new(Request $request)
    {
        $this->validate($request,
            [
                'install_at'=> 'required'
            ]);

        $equipment = new Equipment($request->all());
        $equipment->save();

        return response('', 201);
    }

    public function get(Request $request)
    {
        if ($request->has('install_at')) {
            $query = Equipment::query()
                ->where('install_at', $request->input('install_at'))
                ->orderBy('id', 'asc')->get();
        } else {
            //se nao retorna todos os clientes
            $query = Equipment::query()
                ->where('active', '=', 'true')
                ->orderBy('id', 'asc')->get();
        }

        return response()->json($query, 200);
    }

    public function edit(Request $request, $id)
    {
        try {
            $equipment = Equipment::query()->where([
                'id' => $request->id,
                'active' => true
            ])->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response([
                'message' => trans('errors.model_not_found', [
                ])
            ], 204);
        }

        /** @var Equipment $equipment */
        $equipment->fill($request->all());
        $equipment->save();

        return response($equipment->toArray(), 200);
    }

    public function delete(Request $request, $id)
    {
        $equipment = Equipment::query()->where([
            'id' => $request->id,
            'active' => true,
        ])->findOrFail($id);

        $equipment->active = false;
        $equipment->save();
        $equipment->delete();

        return response('', 200);
    }
}
