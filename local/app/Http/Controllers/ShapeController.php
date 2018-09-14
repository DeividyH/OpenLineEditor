<?php

namespace OpenLineEditor\Http\Controllers;

use Illuminate\Http\Request;

use OpenLineEditor\Http\Requests;
use OpenLineEditor\Http\Controllers\Controller;

use OpenLineEditor\Shapes;
use DB;

class ShapeController extends Controller
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
        //cadastra shape
        $shape = new Shapes;

        $trip_id = $request['trip_id'];
        $shape_pt_sequence = Shapes::where('shape_id', $trip_id)->max('shape_pt_sequence');
        if ($shape_pt_sequence == null)
            $shape->shape_pt_sequence = 1;
        else
            $shape->shape_pt_sequence = $shape_pt_sequence + 1;

        $shape->shape_id = $trip_id;
        $shape->shape_pt_lat = $request['latitude'];
        $shape->shape_pt_lon = $request['longitude'];
        $shape->save();

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
        $max = Shapes::where('shape_id', $id)->max('shape_pt_sequence');
        
        Shapes::where('shape_id', $id)->where('shape_pt_sequence', $max)->delete();

        return response()->json([
            "mensagem" => "deletado"
        ]);
    }

    public function listByTrip($id)
    {
        $shapes = DB::table('shapes')
                    ->where('shapes.shape_id', '=', $id)
                    ->select('shapes.shape_pt_lat', 
                        'shapes.shape_pt_lon',
                        'shapes.shape_pt_sequence')
                    ->orderBy('shapes.shape_pt_sequence', 'asc')
                    ->get();

        return response()->json(
            $shapes
        );
    }
}
