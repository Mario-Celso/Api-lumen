<?php


namespace App\Http\Controllers;



use App\CustomerGroup;

use Illuminate\Http\Request;


class CustomerGroupController extends Controller
{
    public function new(Request $request)
    {
        $this->validate($request,
            [
                'name'=> 'required',
                'description'=>'required'
            ]);

        $customergroup = new CustomerGroup($request->all());

        $customergroup->save();

        return response('', 201);
    }

    public function get(Request $request)
    {
        //se ouver parametro faça
        if ($request->has('name')) {
            $query = CustomerGroup::query()
                ->where('name', $request->input('name'))
                ->orderBy('id', 'asc')->get();
        } else {
            //se nao retorna todos os clientes
            $query = CustomerGroup::query()
                ->where('active', '=', 'true')
                ->orderBy('id', 'asc')
                ->get();
        }
        return response()->json($query, 200);
    }

}
