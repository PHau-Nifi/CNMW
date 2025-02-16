<?php

namespace App\Http\Controllers;
use App\Models\Ticket;

use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function ticket()
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $tickets = Ticket::where('hadScan', 0)->get();
        foreach ($tickets as $value) {
            if(isset($value->schedule)){
                if($value->schedule->date < date('Y-m-d')){
                    $value->hadScan = -1;
                    $value->save();

                }
                if ($value->schedule->endTime <= date('H:i:s')) {
                    $value->hadScan = -1;
                    // $value->save();
                }
                
            }
        }
        $tickets = Ticket::where('hasPaid', 0)->get();
        foreach ($tickets as $value) {
            $value->hasPaid = 1;
            $value->save();
        }
        $ticket = Ticket::orderBy('id', 'DESC')->Paginate(10);
        return view('admin.web.Tickets.index',['ticket'=>$ticket]);
    }
}
