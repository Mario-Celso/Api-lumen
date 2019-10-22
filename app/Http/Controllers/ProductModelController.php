<?php


namespace App\Http\Controllers;


use App\ProductModel;
use Illuminate\Http\Request;

class ProductModelController extends Controller
{
    public function new(Request $request)
    {
        $this->validate($request,
            [
                'model'=> 'required',
                'product_producers_id' => 'required'
            ]);

        $producer = new ProductModel($request->all());

        $producer->save();

        return response($producer, 201);
    }

    public function get(Request $request)
    {  if ($request->has('model')) {
        $query = ProductModel::query()
            ->where('model', $request->input('model'))
            ->orderBy('id', 'asc')
            ->get();
    } else {
        //se nao retorna todos as marcas
        $query = ProductModel::query()
            ->where('active', '=', 'true')
            ->orderBy('id', 'asc')
            ->get();
    }

        return response()->json($query, 200);
    }

//    public function edit(Request $request)
//    {
//
//    }

    public function delete(Request $request, $id)
    {
        $producers = ProductModel::query()->where([
            'id' => $request->id,
            'active' => true,
        ])->findOrFail($id);

        $producers->active = false;
        $producers->save();
        $producers->delete();

        return response('', 200);
    }
}
