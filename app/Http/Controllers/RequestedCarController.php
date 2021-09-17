<?php

namespace App\Http\Controllers;

use App\Events\RequestedCarCreatedEvent;
use App\Models\RequestedCar\RequestedCar;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RequestedCarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requestedCars = RequestedCar::paginate();
        return view('car-requests.index', [
            'requestedCars' => $requestedCars
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('car-requests.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'brand' => 'required',
            'model' => 'required',
            'name' => 'required|string|min:2|max:255',
            'phone' => 'required|string',
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return redirect()->route('car-requests.create')
                ->withErrors($validator)
                ->withInput();
        }

        $requestedCar = RequestedCar::create($request->all());

        $event = event(new RequestedCarCreatedEvent($requestedCar));

        return redirect()->route('car-requests.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RequestedCar\RequestedCar  $requestedCar
     * @return \Illuminate\Http\Response
     */
    public function show(RequestedCar $requestedCar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RequestedCar\RequestedCar  $requestedCar
     * @return \Illuminate\Http\Response
     */
    public function edit(RequestedCar $requestedCar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RequestedCar\RequestedCar  $requestedCar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RequestedCar $requestedCar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RequestedCar\RequestedCar  $requestedCar
     * @return \Illuminate\Http\Response
     */
    public function destroy(RequestedCar $requestedCar)
    {
        //
    }
}
