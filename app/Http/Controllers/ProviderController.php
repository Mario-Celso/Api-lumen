<?php


namespace App\Http\Controllers;


use App\Provider;
use App\ProviderContact;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function new(Request $request)
    {
        $this->validate($request,
        [
            'trade_name' => 'required',
            'company_name' => 'required',
            'opening_date' => 'required',
            'creationing_date' => 'required',
            'city_id'=>'required',
            'federal_tax_id' => 'required',
            'state_tax_id' => 'required',
            'city_tax_id' => 'required',
            'balance' => 'required',
            'status_id' => 'required',
//            'address1' => 'nullable|string',
//            'address2' => 'nullable|string',
//            'address3' => 'nullable|string',
//            'addressNumber' => 'nullable|numeric',
//            'zipcode' => 'nullable|string|size:8',

        ]);

        $provider = new Provider($request->all());

        $provider->save();

        $provider->providers_contacts()->createMany($request->input('providers_contacts'));

        return response('', 201);
    }

    public function get(Request $request)
    {
        //se ouver parametro faça
        if ($request->has('name')) {
            $query = Provider::query()
                ->where('trade_name', $request->input('trade_name'))
                ->orderBy('id', 'asc')
                ->with(['providers_contacts'])
                ->get();
        } else {
            //se nao retorna todos os clientes
            $query = Provider::query()
                ->where('active', '=', 'true')
                ->orderBy('id', 'asc')
                ->with(['providers_contacts'])
                ->get();
        }

        return response()->json($query, 200);
    }

    public function edit(Request $request, $id)
    {
        $this->validate($request, [

            'trade_name' => 'required',
            'company_name' => 'required',
            'opening_date' => 'required',
            'creationing_date' => 'required',
            'city_id'=>'required',
            'federal_tax_id' => 'required',
            'state_tax_id' => 'required',
            'city_tax_id' => 'required',
            'balance' => 'required',
            'status_id' => 'required',
        ]);

        try {
            $provider = Provider::query()->where([
                'id' => $request->id,
                'active' => true
            ])->with(['providers_contacts'])->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response([
                'message' => trans('errors.model_not_found', [
                ])
            ], 204);
        }

        /** @var Provider $provider */
        $provider->fill($request->all());
        $provider->save();

        foreach ($provider->providers_contacts as $contact) {
            /** @var ProviderContact $contact */
            $contact->delete();
        }
        $provider->providers_contacts()->createMany($request->input('providers_contacts'));

        return response($provider->toArray(), 200);
    }

    public function delete(Request $request, $id)
    {
        try {
            $customer = Provider::query()->where([
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

        /** @var Provider $customer */
        $customer->active = false;
        $customer->save();
        $customer->delete();

        return response('', 200);
    }
}
