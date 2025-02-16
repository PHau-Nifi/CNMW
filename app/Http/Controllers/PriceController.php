<?php

namespace App\Http\Controllers;

use App\Models\Price;
use App\Models\RoomType;
use App\Models\SeatType;

use Illuminate\Http\Request;

class PriceController extends Controller
{
    private $hssv2345s;
    private $hssv2345t;
    private $nl2345s;
    private $nl2345t;
    private $nctte2345s;
    private $nctte2345t;
    private $vtt2345s;
    private $vtt2345t;
    private $hssv67cns;
    private $hssv67cnt;
    private $nl67cns;
    private $nl67cnt;
    private $nctte67cns;
    private $nctte67cnt;
    private $vtt67cns;
    private $vtt67cnt;

    public function __construct()
    {
        $this->hssv2345s = Price::where('day', 'weekday')
            ->where('generation', 'hssv')
            ->where('after', '08:00')->get()->first();
        $this->hssv2345t = Price::where('day', 'weekday')
            ->where('generation', 'hssv')
            ->where('after', '17:00')->get()->first();

        $this->nl2345s = Price::where('day', 'weekday')
            ->where('generation', 'nl')
            ->where('after', '08:00')->get()->first();
        $this->nl2345t = Price::where('day', 'weekday')
            ->where('generation', 'nl')
            ->where('after', '17:00')->get()->first();

        $this->nctte2345s = Price::where('day', 'weekday')
            ->where('generation', 'nctte')
            ->where('after', '08:00')->get()->first();
        $this->nctte2345t = Price::where('day', 'weekday')
            ->where('generation', 'nctte')
            ->where('after', '17:00')->get()->first();

        $this->vtt2345s = Price::where('day', 'weekday')
            ->where('generation', 'vtt')
            ->where('after', '08:00')->get()->first();
        $this->vtt2345t = Price::where('day', 'weekday')
            ->where('generation', 'vtt')
            ->where('after', '17:00')->get()->first();

        $this->hssv67cns = Price::where('day', 'weekend')
            ->where('generation', 'hssv')
            ->where('after', '08:00')->get()->first();
        $this->hssv67cnt = Price::where('day', 'weekend')
            ->where('generation', 'hssv')
            ->where('after', '17:00')->get()->first();

        $this->nl67cns = Price::where('day', 'weekend')
            ->where('generation', 'nl')
            ->where('after', '08:00')->get()->first();
        $this->nl67cnt = Price::where('day', 'weekend')
            ->where('generation', 'nl')
            ->where('after', '17:00')->get()->first();

        $this->nctte67cns = Price::where('day', 'weekend')
            ->where('generation', 'nctte')
            ->where('after', '08:00')->get()->first();
        $this->nctte67cnt = Price::where('day', 'weekend')
            ->where('generation', 'nctte')
            ->where('after', '17:00')->get()->first();

        $this->vtt67cns = Price::where('day', 'weekend')
            ->where('generation', 'vtt')
            ->where('after', '08:00')->get()->first();
        $this->vtt67cnt = Price::where('day', 'weekend')
            ->where('generation', 'vtt')
            ->where('after', '17:00')->get()->first();
    }

    public function price()
    {
        $roomTypes = RoomType::where('name', '!=', '2D')->get();
        $seatType = SeatType::where('name', '!=', 'standard')->get();

        return view('admin.web.Price.index', [
            'roomTypes' => $roomTypes,
            'seatTypes' => $seatType,
            'hssv2345s' => $this->hssv2345s->price,
            'hssv2345t' => $this->hssv2345t->price,
            'nl2345s' => $this->nl2345s->price,
            'nl2345t' => $this->nl2345t->price,
            'nctte2345s' => $this->nctte2345s->price,
            'nctte2345t' => $this->nctte2345t->price,
            'vtt2345s' => $this->vtt2345s->price,
            'vtt2345t' => $this->vtt2345t->price,
            'hssv67cns' => $this->hssv67cns->price,
            'hssv67cnt' => $this->hssv67cnt->price,
            'nl67cns' => $this->nl67cns->price,
            'nl67cnt' => $this->nl67cnt->price,
            'nctte67cns' => $this->nctte67cns->price,
            'nctte67cnt' => $this->nctte67cnt->price,
            'vtt67cns' => $this->vtt67cns->price,
            'vtt67cnt' => $this->vtt67cnt->price,
        ]);
    }

    public function edit(Request $request)
    {
        $this->hssv2345s->price = $request->hssv2345s;
        $this->hssv2345s->save();

        $this->hssv2345t->price = $request->hssv2345t;
        $this->hssv2345t->save();

        $this->nl2345s->price = $request->nl2345s;
        $this->nl2345s->save();

        $this->nl2345t->price = $request->nl2345t;
        $this->nl2345t->save();

        $this->nctte2345s->price = $request->nctte2345s;
        $this->nctte2345s->save();

        $this->nctte2345t->price = $request->nctte2345t;
        $this->nctte2345t->save();

        $this->vtt2345s->price = $request->vtt2345s;
        $this->vtt2345s->save();

        $this->vtt2345t->price = $request->vtt2345t;
        $this->vtt2345t->save();

        $this->hssv67cns->price = $request->hssv67cns;
        $this->hssv67cns->save();

        $this->hssv67cnt->price = $request->hssv67cnt;
        $this->hssv67cnt->save();

        $this->nl67cns->price = $request->nl67cns;
        $this->nl67cns->save();

        $this->nl67cnt->price = $request->nl67cnt;
        $this->nl67cnt->save();

        $this->nctte67cns->price = $request->nctte67cns;
        $this->nctte67cns->save();

        $this->nctte67cnt->price = $request->nctte67cnt;
        $this->nctte67cnt->save();

        $this->vtt67cns->price = $request->vtt67cns;
        $this->vtt67cns->save();

        $this->vtt67cnt->price = $request->vtt67cnt;
        $this->vtt67cnt->save();

        $roomTypes = RoomType::where('name', '!=', '2D')->get();
        foreach ($roomTypes as $roomType) {
            $rt = RoomType::find($roomType->id);
            $rt->surcharge = $request[$roomType->name];
            $rt->save();
            unset($rt);
        }

        $seatTypes = SeatType::where('name', '!=', 'standard')->get();

        foreach ($seatTypes as $seatType) {
            $st = SeatType::find($seatType->id);
            $st->surcharge = $request[$seatType->name];
            $st->save();
            unset($st);
        }

        return redirect('admin/prices')->with('success', 'Saved!');
    }
}
