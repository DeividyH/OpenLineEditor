<?php

namespace OpenLineEditor\Http\Controllers;

use Illuminate\Http\Request;

use OpenLineEditor\Http\Requests;
use OpenLineEditor\Http\Controllers\Controller;

use OpenLineEditor\Stops;
use OpenLineEditor\StopTimes_Config;
use DB;

class StopController extends Controller
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
        //cadastra stop
        $stop = new Stops;

        $stop->stop_name = $request['nome_ponto'];
        $stop->stop_lat = $request['latitude_ponto'];
        $stop->stop_lon = $request['longitude_ponto'];
        $stop->save();
        
        //cadastra stop times config
        $stop_t_config = new StopTimes_Config;

        $stop_t_config->trip_id = $request['trip_id'];
        $stop_t_config->stop_id = $stop->id;
        $stop_t_config->save();

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
        Stops::where('stop_id', $id)->delete();
        StopTimes_Config::where('stop_id', $id)->delete();

        return response()->json([
            "mensagem" => "deletado"
        ]);
    }

    public function listByTrip($id)
    {
        $stops = DB::table('stops')
                    ->join('stop_times_configs', 'stop_times_configs.stop_id', '=', 'stops.stop_id')
                    ->where('stop_times_configs.trip_id', '=', $id)
                    ->select('stops.stop_id',
                        'stops.stop_name',
                        'stops.stop_lat',
                        'stops.stop_lon')
                    ->groupBy('stops.stop_id')
                    ->get();

        return response()->json(
            $stops
        );
    }
}
