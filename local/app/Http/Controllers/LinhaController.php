<?php

namespace OpenLineEditor\Http\Controllers;

use Illuminate\Http\Request;

use OpenLineEditor\Http\Requests;
use OpenLineEditor\Http\Requests\LinhaRequest;
use OpenLineEditor\Http\Controllers\Controller;
use Session;
use Redirect;
use Auth;
Use DB;
use OpenLineEditor\Routes;
use OpenLineEditor\Routes_Status;
use OpenLineEditor\Agency;

class LinhaController extends Controller
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
        $agencies = Agency::all();
        return view('user_painel.cadastra_linha')->with('agencies', $agencies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LinhaRequest $request)
    {
        //cadastra rota
        $route = new Routes;
        $route->agency_id = $request['agencia'];
        $route->user_id = Auth::user()->id;
        $route->route_short_name = $request['nome_abreviado_da_linha'];
        $route->route_long_name = $request['nome_completo_da_linha'];
        $route->route_type = 3;
        $route->save();

        //cadastra status da rota
        $route_status = new Routes_Status;
        $route_status->route_id = $route->id;
        $route_status->save();

        //redireciona
        Session::flash('message','Sucesso! Linha cadastrada com sucesso.');
        return Redirect::to('/painel/route/create');
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
        $route_status = Routes_Status::where('route_id', $id)->first();

        //verifica se a linha esta travada para algum usuario
        if ($route_status->editing == 0){
            //travar a linha
            $route_status->editing = 1;
            $route_status->save();

            $route = Routes::where('route_id', $id)->get();
            return view('user_painel.edita_linha')->with('route', $route);
        } else {
            Session::flash('message','Falha! Um outro usuário está editando essa linha. Tente mais tarde.');
            return Redirect::to('/painel');
        }
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
        Routes::where('route_id', $id)
            ->update(array('agency_id' => $request['agencia'],
                'route_short_name' => $request['nome_abreviado'],
                'route_long_name' => $request['nome_completo']));

        return response()->json([
            "mensagem" => "salvo"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Routes::where('route_id', $id)->delete();
        return Redirect::to('/painel');
    }

    public function liberar($id){
        $route_status = Routes_Status::where('route_id', $id)->first();
        $route_status->editing = 0;
        $route_status->save();

        return response()->json([
            "mensagem" => "salvo"
        ]);
    }

    public function listarTrajetosDaLinha($id){
      $trips = DB::table('routes')
          ->join('trips', 'trips.route_id', '=', 'routes.route_id')
          ->join('shapes', 'shapes.shape_id', '=', 'trips.trip_id')
          ->where('routes.route_id', '=', $id)
          ->select('trips.trip_id', 'shapes.shape_pt_lat', 'shapes.shape_pt_lon', 'shapes.shape_pt_sequence')
          ->orderBy('trips.trip_id', 'asc')
          ->orderBy('shapes.shape_pt_sequence', 'asc')
          ->get();

      return response()->json($trips);

      //return $trips[6]->trip_id;
    }

    public function listarPontosDaLinha($id){
      $stops = DB::table('routes')
          ->join('trips', 'trips.route_id', '=', 'routes.route_id')
          ->join('stop_times_configs', 'stop_times_configs.trip_id', '=', 'trips.trip_id')
          ->join('stops', 'stops.stop_id', '=', 'stop_times_configs.stop_id')
          ->where('routes.route_id', '=', $id)
          ->select('trips.trip_short_name', 'stops.stop_name','stops.stop_lat', 'stops.stop_lon')
          ->get();

      return response()->json(
          $stops
      );
    }
}
