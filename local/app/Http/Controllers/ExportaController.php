<?php

namespace OpenLineEditor\Http\Controllers;

use Illuminate\Http\Request;

use OpenLineEditor\Http\Requests;
use OpenLineEditor\Http\Controllers\Controller;
use ZipArchive;
use Response;
use Storage;
use Session;
use Redirect;
use OpenLineEditor\Agency;
use OpenLineEditor\Stops;
use OpenLineEditor\Routes;
use OpenLineEditor\Trips;
use OpenLineEditor\Stop_Times;
use OpenLineEditor\Calendar;
use OpenLineEditor\Shapes;

class ExportaController extends Controller
{
    public function obterAgency(){
      $agencies = Agency::all();
      $content = '"agency_id","agency_name","agency_url","agency_timezone"' . "\n";

      foreach ($agencies as $agency) {
        $content .= '"' . $agency->agency_id .
            '","' . $agency->agency_name .
            '","' . $agency->agency_url .
            '","' . $agency->agency_timezone .
            '"' ."\n";
      }

      return $content;
    }

    public function obterStops(){
      $stops = Stops::all();
      $content = '"stop_id","stop_name","stop_lat","stop_lon"' . "\n";

      foreach ($stops as $stop) {
        $content .= '"' . $stop->stop_id .
            '","' . $stop->stop_name .
            '","' . $stop->stop_lat .
            '","' . $stop->stop_lon .
            '"' ."\n";
      }

      return $content;
    }

    public function obterRoutes(){
      $routes = Routes::all();
      $content = '"route_id","agency_id","user_id","route_short_name","route_long_name","route_type"' . "\n";

      foreach ($routes as $route) {
        $content .= '"' . $route->route_id .
            '","' . $route->agency_id .
            '","' . $route->user_id .
            '","' . $route->route_short_name .
            '","' . $route->route_long_name .
            '","' . $route->route_type .
            '"' ."\n";
      }

      return $content;
    }

    public function obterTrips(){
      $trips = Trips::all();
      $content = '"route_id","service_id","trip_id","trip_short_name"' . "\n";

      foreach ($trips as $trip) {
        $content .= '"' . $trip->route_id .
            '","' . $trip->service_id .
            '","' . $trip->trip_id .
            '","' . $trip->trip_short_name .
            '"' ."\n";
      }

      return $content;
    }

    public function obterStopTimes(){
      $stop_times = Stop_Times::all();
      $content = '"trip_id","arrival_time","departure_time","stop_id","stop_sequence"' . "\n";

      foreach ($stop_times as $stop_time) {
        $content .= '"' . $stop_time->trip_id .
            '","' . $stop_time->arrival_time .
            '","' . $stop_time->departure_time .
            '","' . $stop_time->stop_id .
            '","' . $stop_time->stop_sequence .
            '"' ."\n";
      }

      return $content;
    }

    public function obterCalendar(){
      $calendars = Calendar::all();
      $content = '"service_id","monday","tuesday","wednesday","thursday","friday","saturday","sunday","start_date","end_date"' . "\n";

      foreach ($calendars as $calendar) {
        $content .= '"' . $calendar->service_id .
            '","' . $calendar->monday .
            '","' . $calendar->tuesday .
            '","' . $calendar->wednesday .
            '","' . $calendar->thursday .
            '","' . $calendar->friday .
            '","' . $calendar->saturday .
            '","' . $calendar->sunday .
            '","' . $calendar->start_date .
            '","' . $calendar->end_date .
            '"' ."\n";
      }

      return $content;
    }

    public function obterShapes(){
      $shapes = Shapes::all();
      $content = '"shape_id","shape_pt_lat","shape_pt_lon","shape_pt_sequence"' . "\n";

      foreach ($shapes as $shape) {
        $content .= '"' . $shape->shape_id .
            '","' . $shape->shape_pt_lat .
            '","' . $shape->shape_pt_lon .
            '","' . $shape->shape_pt_sequence .
            '"' ."\n";
      }

      return $content;
    }

    public function exportarArquivo($nome_arquivo){
      switch($nome_arquivo){
        case "agency":
          $content = $this->obterAgency();
          break;
        case "stops":
          $content = $this->obterStops();
          break;
        case "routes":
          $content = $this->obterRoutes();
          break;
        case "trips":
          $content = $this->obterTrips();
          break;
        case "stoptimes":
          $content = $this->obterStopTimes();
          break;
        case "calendar":
          $content = $this->obterCalendar();
          break;
        case "shapes":
          $content = $this->obterShapes();
          break;
        default:
          //
      }

      return Response::make($content, '200', array(
        'Content-Type' => 'application/octet-stream',
        'Content-Disposition' => 'attachment; filename="'. $nome_arquivo .'.txt"'
      ));
    }

    public function exportarZip(){
      $zip = new ZipArchive();
      $zip_path = public_path('/../../zip/OpenLineEditor.zip');

      if ($zip->open($zip_path, ZIPARCHIVE::OVERWRITE)!==TRUE) {
          echo "erro ao gerar zip";
      }

      $content = $this->obterAgency();
      $zip->addFromString('agency.txt', $content);

      $content = $this->obterStops();
      $zip->addFromString('stops.txt', $content);

      $content = $this->obterRoutes();
      $zip->addFromString('routes.txt', $content);

      $content = $this->obterTrips();
      $zip->addFromString('trips.txt', $content);

      $content = $this->obterStopTimes();
      $zip->addFromString('stoptimes.txt', $content);

      $content = $this->obterCalendar();
      $zip->addFromString('calendar.txt', $content);

      $content = $this->obterShapes();
      $zip->addFromString('shapes.txt', $content);

      $zip->close();

      Session::flash('message','Sucesso! O arquivo de exportação zip foi atualizado.');
      return Redirect::to('export');
    }

    public function downloadZip(){
      $zip_path = public_path('/../../zip/OpenLineEditor.zip');

      return response()->download($zip_path);
    }
}
