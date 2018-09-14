<?php

namespace OpenLineEditor\Http\Controllers;

use Illuminate\Http\Request;

use OpenLineEditor\Http\Requests;
use OpenLineEditor\Routes;
use Auth;
use Redirect;
use View;
use DB;
use OpenLineEditor\Http\Controllers\Controller;

class UserPainelController extends Controller
{
    public function index(){
    	if (Auth::check())
        {
            $user_id = Auth::user()->id;
            $count = Routes::where('user_id', $user_id)->count();

            if($count > 0){
                $routes = DB::table('routes')
                    ->join('users', 'users.id', '=', 'routes.user_id')
                    ->join('agencies', 'agencies.agency_id', '=', 'routes.agency_id')
                    ->where('users.id', '=', $user_id)
                    ->select('agencies.agency_name', 'routes.route_id', 'routes.route_long_name', 'routes.route_short_name')
                    ->orderBy('routes.route_id', 'asc')
                    ->get();
                return view('user_painel.index')->with('linhas', $routes);
            }
            else{
                return view('user_painel.index')->with('linhas', 'false');
            }

		}
		else
        {
			return Redirect::to('/');
		}
    }

    public function allLines(){
            $count = Routes::count();

            if($count > 0){
                $routes = DB::table('routes')
                    ->join('agencies', 'agencies.agency_id', '=', 'routes.agency_id')
                    ->select('agencies.agency_name', 'routes.route_id', 'routes.route_long_name', 'routes.route_short_name')
                    ->orderBy('routes.route_id', 'asc')
                    ->get();
                return view('user_painel.listar_linhas')->with('linhas', $routes);
            }
            else{
                return view('user_painel.listar_linhas')->with('linhas', 'false');
            }
    }
    
    public function tutorial(){
        return view("user_painel.tutorial");
    }
}
