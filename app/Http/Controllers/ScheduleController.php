<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Schedule;
use App\Models\Theater;
use App\Models\Ticket;
use Carbon\Carbon;

use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function schedule(Request $request)
    {
        Schedule::where('date', '<', date('Y-m-d'))->update(['status' => false]);
        Schedule::where('date', '=', date('Y-m-d'))->where('endTime', '<=', date('H:i:s'))->update(['status' => false]);
        Movie::where('endDate', '<', date('Y-m-d'))->update(['status' => false]);

        $schedules = Schedule::all();
        $theaters = Theater::all()->where('status',1);
        if (isset($request->theater) && isset($request->date)) {
            $date_cur = $request->date;
            $theater_cur = Theater::find($request->theater);
        } else {
            $date_cur = Carbon::today()->format('Y-m-d');
            $theater_cur = Theater::find(1);
        }
        $movies = Movie::whereDate('endDate', '>=', $date_cur)->get();
        return view('admin.web.Schedules.index', [
            'theaters' => $theaters,
            'date_cur' => $date_cur,
            'theater_cur' => $theater_cur,
            'schedules' => $schedules,
            'movies' => $movies,
            'endTimeLatest' => '',
        ]);
    }

    public function postCreate(Request $request)
    {
        $movie = Movie::find($request->movie);
        $endTimeTemp = strtotime($request->startTime) + ($movie->showTime * 60);
        $endTimeHour = date('H', $endTimeTemp);
        $endTimeMinutes = date('i', $endTimeTemp);
        $endTimeMinutesRounded = (int)((round($endTimeMinutes) % 5 === 0) ? round($endTimeMinutes) : round(($endTimeMinutes + 5 / 2) / 5) * 5);
        if ($endTimeMinutesRounded == 60) {
            $endTimeHour++;
            $endTimeMinutesRounded = 0;
        }
        $startTime = $request->startTime;
        $endTime = $endTimeHour . ':' . $endTimeMinutesRounded;
        $endTimeLastest[$request->room] = $endTime;
        if ($request->remainingSchedules) {
            do {
                $schedule = new Schedule([
                    'room_id' => $request->room,
                    'movie_id' => $request->movie,
                    'audio' => $request->audio,
                    'subtitle' => $request->subtitle,
                    'date' => $request->date,
                    'startTime' => $startTime,
                    'endTime' => $endTime,
                ]);
                $schedule->save();
            
                $startTime = date('H:i', strtotime('+10 minutes', strtotime($schedule->endTime)));
                
                $endTimeTemp = strtotime($startTime) + ($movie->showTime * 60);
            
                $endTimeHour = date('H', $endTimeTemp);
                $endTimeMinutes = date('i', $endTimeTemp);
                $endTimeMinutesRounded = (int)((round($endTimeMinutes / 5) * 5) % 60);

                if ($endTimeMinutesRounded == 60) {
                    $endTimeHour++;
                    $endTimeMinutesRounded = 0;
                }
                $endTime = sprintf('%02d:%02d', $endTimeHour, $endTimeMinutesRounded);
                $endTimeLastest[$request->room] = $endTime;
                
                unset($schedule);
            
            } while ($endTime < '22:00' && $endTime > '08:00');
            
            $schedule = new Schedule([
                'room_id' => $request->room,
                'movie_id' => $request->movie,
                'audio' => $request->audio,
                'subtitle' => $request->subtitle,
                'date' => $request->date,
                'startTime' => $startTime,
                'endTime' => $endTime,
            ]);
            $schedule->save();
            unset($schedule);
        } else {

            $schedule = new Schedule([
                'room_id' => $request->room,
                'movie_id' => $request->movie,
                'audio' => $request->audio,
                'subtitle' => $request->subtitle,
                'date' => $request->date,
                'startTime' => $request->startTime,
                'endTime' => $endTime,
            ]);
            $schedule->save();
        }

        return redirect('admin/schedule?theater=' . $request->theater . '&date=' . $request->date );
    }

    public function status(Request $request)
    {
        $schedule = Schedule::find($request->schedule_id);
        $schedule['status'] = $request->active;
        $schedule->save();
        return response('success',200);
    }

    public function early_status(Request $request)
    {
        $schedule = Schedule::find($request->early_id);
        $schedule['early'] = $request->active;
        $schedule->save();
        return response('success',200);
    }

    public function delete($id, Request $request)
    {
        $schedule = Schedule::find($id);
        if ($schedule['status'] == 0) {
            Schedule::destroy($id);
            return redirect('admin/schedule?theater=' . $request->theater . '&date=' . $request->date)->with('success', 'Xóa thành công!');
        } else {
            return redirect('admin/schedule?theater=' . $request->theater . '&date=' . $request->date)->with('error', "Vui lòng chuyển trạng thái sang offline!");
        }

    }

    public function deleteAll(Request $request)
    {
        Schedule::where('room_id', $request->room_id)->where('date', $request->date)->delete();
        return response()->json([
            'success'=>'Xóa thành công!'
        ]);
    }
}
