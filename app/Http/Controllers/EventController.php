<?php

namespace App\Http\Controllers;

use App\Models\event;
use Illuminate\Http\Request;
// use response;
use Illuminate\Http\Response;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $now = now()->toDateTimeString();

        $all = Event::select('id', 'end', 'status')->get();
        foreach ($all as $key => $insert) {
            if ($insert->end > $now) {
                $status = 'انتظار';
            } else {
                $status = 'منتهية';
            }
            $updateArr = [
                'status' => $status,
            ];
            Event::where('id', '=', $insert->id)->update($updateArr);
        }
        if (request()->ajax()) {

            $start = (!empty($_GET["start"])) ? ($_GET["start"]) : ('');
            $end = (!empty($_GET["end"])) ? ($_GET["end"]) : ('');

            $data = Event::whereDate('start', '>=', $start)->whereDate('end',   '<=', $end)
                ->get(['id', 'title', 'patient', 'description', 'start', 'start_time', 'end', 'end_time', 'status']);


            return response()->json($data);
        }
        return view('calendars.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $now = now()->toDateTimeString();
        $status = '';
        if ($request->new_end > $now) {
            $status = 'انتظار';
        } else {
            $status = 'منتهية';
        }
        $insertArr = [
            'title' => $request->title,
            'patient' => $request->patient,
            'description' => $request->description,
            'start' => $request->new_start,
            'start_time' => $request->start_time,
            'end' => $request->new_end,
            'end_time' => $request->end_time,
            'status' => $status,
        ];
        $event = Event::create($insertArr);
        return response()->json($event);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, event $event)
    {
        $where = array('id' => $request->id);
        $now = now()->toDateTimeString();
        $status = '';
        if ($request->new_end > $now) {
            $status = 'انتظار';
        } else {
            $status = 'منتهية';
        }
        $updateArr = [
            'title' => $request->edit_title,
            'patient' => $request->edit_patient,
            'description' => $request->edit_description,
            'start' => $request->new_start,
            'start_time' => $request->edit_start_time,
            'end' => $request->new_end,
            'end_time' => $request->edit_end_time,
            'status' => $status,
        ];
        $event  = Event::where($where)->update($updateArr);

        return response()->json($event);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\event  $event
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $event = Event::where('id', $request->id)->delete();

        return response()->json($event);
    }


    public function weeklycreate(Request $request)
    {
        $now = now()->toDateTimeString();

        if ($request->type == 'week') {
            foreach ($request->full as $key => $insert) {
                $start_date = $insert[2] . ' ' . $insert[0];
                $end_date = $insert[2] . ' ' . $insert[1];
                // dd($start_date);
                $insertArr = [
                    'title' => $request->week_title,
                    'patient' => $request->week_patient,
                    'description' => $request->week_description,
                    'start' => $start_date,
                    'start_time' => $insert[0],
                    'end' => $end_date,
                    'end_time' => $insert[1],
                    'status' => 'انتظار',
                ];
                $event = Event::create($insertArr);
            }
            return response()->json($event);
        } else {
            foreach ($request->full_between as $key => $insert) {
                if ($key > $now) {
                    $status = 'انتظار';
                } else {
                    $status = 'منتهية';
                }
                $start_date = $key . ' ' . $insert[0];
                $end_date = $key . ' ' . $insert[1];
                $insertArr = [
                    'title' => $request->week_title,
                    'patient' => $request->week_patient,
                    'description' => $request->week_description,
                    'start' => $start_date,
                    'start_time' => $insert[0],
                    'end' => $end_date,
                    'end_time' => $insert[1],
                    'status' => $status,
                ];
                $event = Event::create($insertArr);
            }
            return response()->json($event);
        }
    }
}
