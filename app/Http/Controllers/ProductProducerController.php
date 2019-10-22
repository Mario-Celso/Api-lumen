<?php


namespace App\Http\Controllers;


use App\ProductProducer;
use Illuminate\Http\Request;

class ProductProducerController extends Controller
{
    public function new(Request $request)
    {
        $this->validate($request,
        [
            'name'=> 'required'
        ]);

        $producer = new ProductProducer($request->all());
        $producer->save();

        $producer->model()->createMany($request->input('product_models'));

        return response($producer, 201);
    }

    public function get(Request $request)
    {  if ($request->has('name')) {
        $query = ProductProducer::query()
            ->where('name', $request->input('name'))
            ->with(['model'])
            ->orderBy('id', 'asc')
            ->get();
    } else {
        //se nao retorna todos as marcas
        $query = ProductProducer::query()
            ->where('active', '=', 'true')
            ->with(['model'])
            ->orderBy('id', 'asc')
            ->get();
    }

        return response()->json($query, 200);
    }

    public function edit(Request $request, $id)
    {
        try {
            $product = ProductProducer::query()->where([
                'id' => $request->id,
                'active' => true
            ])->with(['product_models'])->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response([
                'message' => trans('errors.model_not_found', [
                ])
            ], 204);
        }

        /** @var ProductProducer $product */
        $product->fill($request->all());
        $product->save();

        foreach ($product->product_models as $model) {
            /** @var ProductProducer $model */
            $model->delete();
        }
        $product->model()->createMany($request->input('product_models'));

        return response($product->toArray(), 200);
    }

    public function delete(Request $request, $id)
    {
        $producers = ProductProducer::query()->where([
            'id' => $request->id,
            'active' => true
        ])->findOrFail($id);

        $producers->active = false;
        $producers->save();
        $producers->delete();

        return response('', 200);
    }
}
