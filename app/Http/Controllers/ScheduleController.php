<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ScheduleController extends Controller
{
    public function create(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'type' => 'required',
            'line' => 'required',
            'from_place_id' => 'required|exists:place,id',
            'to_place_id' => 'required|exists:place,id',
            'departure_time' => 'required',
            'arrival_time' => 'required',
            'distance' => 'required',
            'speed' => 'required',
        ]);

        if($validation->fails())
            return $this->validationError($validation->errors());

        Schedule::create($request->only(['type', 'line', 'from_place_id', 'to_place_id', 'departure_time', 'arrival_time', 'distance', 'speed']));

        return response([
            'body' => [
                'message' => 'create success'
            ]
        ]);
    }

    public function destroy(Request $request, Schedule $schedule)
    {
        $schedule->delete();
        return response([
            'body' => [
                'message' => 'delete success'
            ]
        ]);
    }
}
