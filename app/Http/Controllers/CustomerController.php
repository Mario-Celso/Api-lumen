<?php

namespace App\Http\Controllers;


use App\Customer;
use App\Contact;
use App\Services\ModelRuler\ModelRuler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;


class CustomerController extends Controller
{

    public function new(Request $request)
    {
        $this->validate($request,
        [
            'status_id'=> 'required',
            'balance'=> 'required',
            'name'=> 'required',
            'notes'=> 'required',
            'birthdate'=> 'required',
            'state_tax_id'=> 'required',
            'city_tax_id'=> 'required',
        ]);

        $customer = new Customer($request->all());
        $customer->save();

        $customer->contacts()->createMany($request->input('contacts'));

        return response('', 201);
    }

    public function get(Request $request)
    {
        //se ouver parametro faça
        if ($request->has('name')) {
            $query = Customer::query()
                ->where('name', $request->input('name'))
                ->with(['contacts'])
                ->orderBy('id', 'asc')->get();
        } else {
            //se nao retorna todos os clientes
            $query = Customer::query()
                ->where('active', '=', 'true')
                ->with(['contacts'])
                ->orderBy('id', 'asc')->get();
        }

        return response()->json($query, 200);
    }

    public function edit(Request $request, $id)
    {
        $this->validate($request, [

            'status_id'=> 'required',
            'balance'=> 'required',
            'name'=> 'required',
            'notes'=> 'required',
            'birthdate'=> 'required',
            'state_tax_id'=> 'required',
            'city_tax_id'=> 'required',
        ]);

        try {
            $customer = Customer::query()->where([
                'id' => $request->id,
                'active' => true
            ])->with(['contacts'])->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response([
                'message' => trans('errors.model_not_found', [
                ])
            ], 204);
        }

        /** @var Customer $customer */
        $customer->fill($request->all());
        $customer->save();

            foreach ($customer->contacts as $contact) {
                /** @var Contact $contact */
                $contact->delete();

                $customer->contacts()->createMany($request->input('contacts'));
        }

        return response('', 200);
    }

    public function delete(Request $request, $id)
    {
        try {
            $customer = Customer::query()->where([
                'id' => $request->id,
                'active' => true,
            ])->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response([
                'message' => trans('errors.model_not_found', [
                    'entity' => trans('entities.customer'),
                    'gender' => trans('entities_genders.customer')
                ])
            ], 204);
        }

        /** @var Customer $customer */
        $customer->active = false;
        $customer->save();
        $customer->delete();

        return response('', 200);
    }
}
