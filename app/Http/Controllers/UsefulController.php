<?php

namespace App\Http\Controllers;

use App\City;
use App\ProductProducer;
use App\State;
use App\Status;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;


class UsefulController extends Controller
{
    public function states()
    {
        return State::query()
            ->orderBy('id', 'asc')
            ->get();
    }

    public function cities(Request $request)
    {
        if ($request->has('name') && $request->has('initials')) {
            $requestcity = strtolower( strtr(utf8_decode($request->name),
                utf8_decode('àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ '),
                'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY-'));

            $query =  City::query()
                ->whereHas('state', function($q) use($request) {
                    /** @var Builder $q  */
                        $q->where('initials', $request->initials);
                })
                ->where('slug', $requestcity);
        } else {
            $query =  City::query()
                ->where('state_id', $request->input('state_id'))
                ->orderBy('id', 'asc');
        }

        return $query->get();
    }

    public function status()
    {
        return Status::all();
    }

    public function producer()
    {
        return ProductProducer::all();
    }

}
