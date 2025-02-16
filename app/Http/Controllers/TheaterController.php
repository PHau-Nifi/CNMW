<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Theater;
use App\Models\SeatType;
use App\Models\RoomType;
use Carbon\Carbon;

class TheaterController extends Controller
{
    public function theater()
    {
        $theaters = Theater::all();
        $seatTypes = SeatType::all();
        $roomTypes = RoomType::all();
        return view('admin.web.theaters.index', [
            'theaters' => $theaters,
            'seatTypes' => $seatTypes,
            'roomTypes' => $roomTypes
        ]);
    }

    public function postCreate(Request $request)
    {
        $theater = new Theater([
            'name' => $request->name,
            'address' => $request->address,
            'city' => $request->city,
            'location' => $request->location,
            'created_at' => Carbon::today(),
            'updated_at' => null,
        ]);

        $theater->save();
        return redirect('/admin/theater')->with('success', 'Thêm rạp phim thành công!');
    }

    public function status(Request $request)
    {
        $theaters = Theater::find($request->theater_id);
        $theaters['status'] = $request->active;
        $theaters->save();
        return response('success', 200);
    }

    public function postEdit($id, Request $request)
    {

        $theater = Theater::find($id);
        $theater->name = $request->name;
        $theater->address = $request->address;
        $theater->city = $request->city;
        $theater->location = $request->location;
        $theater->updated_at = Carbon::today();

        $theater->save();
        return redirect('/admin/theater')->with('success', 'Cập nhật ' . $theater->name . ' thành công !');
    }

}
