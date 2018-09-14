<?php

namespace OpenLineEditor\Http\Controllers;

use Illuminate\Http\Request;

use OpenLineEditor\Http\Requests;
use OpenLineEditor\Http\Controllers\Controller;
use Session;
use Redirect;
use Auth;
use DB;
use OpenLineEditor\Trips;
use OpenLineEditor\Calendar;

class TrajetoController extends Controller
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
        $calendar = new Calendar;

        $calendar->monday = $request['monday'];
        $calendar->tuesday = $request['tuesday'];
        $calendar->wednesday = $request['wednesday'];
        $calendar->thursday = $request['thursday'];
        $calendar->friday = $request['friday'];
        $calendar->saturday = $request['saturday'];
        $calendar->sunday = $request['sunday'];
        $calendar->start_date = str_replace("-", "", $request['start_date']);
        $calendar->end_date = str_replace("-", "", $request['end_date']);
        $calendar->save();

        //cadastra trip
        $trip = new Trips;

        $trip->route_id = $request['route_id'];
        $trip->service_id = $calendar->id;
        $trip->trip_short_name = $request['trip_name'];
        $trip->save();

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
        $trip = Trips::where('trip_id', $id)->first();

        Trips::where('trip_id', $id)->delete();
        Calendar::where('service_id', $trip->service_id)->delete();

        return response()->json([
            "mensagem" => "deletado"
        ]);
    }

    public function listByRoute($id)
    {
        $trips = DB::table('trips')
                    ->join('routes', 'routes.route_id', '=', 'trips.route_id')
                    ->join('calendars', 'calendars.service_id', '=', 'trips.service_id')
                    ->where('routes.route_id', '=', $id)
                    ->select('trips.trip_id', 
                        'trips.trip_short_name',
                        'calendars.monday', 
                        'calendars.tuesday',
                        'calendars.wednesday',
                        'calendars.thursday',
                        'calendars.friday',
                        'calendars.saturday',
                        'calendars.sunday',
                        'calendars.start_date', 
                        'calendars.end_date')
                    ->orderBy('trips.trip_id', 'asc')
                    ->get();

        return response()->json(
            $trips
        );
    }
}
