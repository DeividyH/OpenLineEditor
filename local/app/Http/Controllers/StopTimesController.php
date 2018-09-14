<?php

namespace OpenLineEditor\Http\Controllers;

use Illuminate\Http\Request;

use OpenLineEditor\Http\Requests;
use OpenLineEditor\Stop_Times;
use OpenLineEditor\Http\Controllers\Controller;
use DB;

class StopTimesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //cadastra calendar
        $stop_t = new Stop_Times;

        $stop_t->trip_id = $request['trip_id'];
        $stop_t->stop_id = $request['stop_id'];
        $stop_t->arrival_time = $request['hora_chegada'];
        $stop_t->departure_time = $request['hora_partida'];
        $stop_t->stop_sequence = 1;
        $stop_t->save();

        //retorna mensagem
        return response()->json([
            "mensagem" => "salvo"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Stop_Times::where('stoptimes_id', $id)->delete();

        return response()->json([
            "mensagem" => "deletado"
        ]);
    }

    public function listByStop($id)
    {
        $stops_t = DB::table('stop_times')
                    ->join('stops', 'stops.stop_id', '=', 'stop_times.stop_id')
                    ->where('stops.stop_id', '=', $id)
                    ->select('stop_times.stoptimes_id', 'stop_times.arrival_time', 'stop_times.departure_time')
                    ->orderBy('stop_times.arrival_time')
                    ->get();

        return response()->json($stops_t);
    }
}
