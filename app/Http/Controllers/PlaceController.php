<?php

namespace App\Http\Controllers;

use App\Http\Resources\PlaceResource;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PlaceController extends Controller
{

    public function create(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'x' => 'required',
            'y' => 'required',
            'image' => 'required',
            'description' => 'required',
        ]);

        if($validation->fails())
            return $this->validationError($validation->errors());

        $request->image = $request->file('image')->store('public');
        Place::create($request->only(['name', 'latitude', 'longitude', 'x', 'y', 'image', 'description']));
        return response([
            'body' => [
                'message' => 'create success'
            ]
        ]);

    }

    public function find(Request $request, Place $place)
    {
        return  response([
            'body' => [
                'place' => PlaceResource::make($place)
            ]
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function show(Place $place)
    {
        return  response([
            'body' => [
                'places' => PlaceResource::collection(Place::all())
            ]
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function edit(Place $place)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Place $place)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'x' => 'required',
            'y' => 'required',
            'image' => 'required',
            'description' => 'required',
        ]);

        if($validation->fails())
            return $this->validationError($validation->errors());

        if(!$place){
            return response([
                'body' => [
                    'message' => 'Data cannot be deleted'
                ]
            ],401);
        }
        $place->image = $request->file('image')->store('public');
        $place->name = $request->name;
        $place->latitude = $request->latitude;
        $place->longitude = $request->longitude;
        $place->x = $request->x;
        $place->y = $request->y;
        $place->description = $request->description;

        $place->save();

        return response([
            'body' => [
                'message' => 'update success'
            ]
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param \App\Models\Place $place
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Request $request, Place $place)
    {
        if(!$place){
            return response([
                'body' => [
                    'message' => 'Data cannot be deleted'
                ]
            ],401);
        }
        $place->delete();
        return response([
            'body' => [
                'message' => 'delete success'
            ]
        ]);
    }
}
