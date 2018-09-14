@extends("layout.main")

<?php $message=Session::get('message')?>

@section("conteudo-pagina")
<div id="conteudo-pagina">
        <p id="titulo-pagina">Exportar</p>

        @include('alerts.success_message')

        <div class="col-lg-8" style="margin-top: 20px;">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-9">
                            <div>Zip File (OpenLineEditor.zip)</div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                	Todos os arquivos do sistema no padrão GTFS em formato zip.
                    <BR>
                    <a href="{!! URL::to('/export/zip') !!}">Atualizar</a>
                    <a href="{!! URL::to('/export/zip/download') !!}" target="_blank">Download</a>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-8" style="margin-top: 20px;">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-9">
                            <div>Agencies (agency.txt)</div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                	Uma ou mais agências que provêm os dados de transito informados.
                    <BR><a href="{!! URL::to('/export/file/agency') !!}" target="_blank">Download</a>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-8" style="margin-top: 20px;">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-9">
                            <div>Stops (stops.txt)</div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                	Locais onde há paradas para buscar ou deixar passageiros.
                    <BR><a href="{!! URL::to('/export/file/stops') !!}" target="_blank">Download</a>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-8" style="margin-top: 20px;">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-9">
                            <div>Routes (routes.txt)</div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                	Todas rotas de trânsito. Sequência de trajetos que serão mostrados para os motoristas.
                    <BR><a href="{!! URL::to('/export/file/routes') !!}" target="_blank">Download</a>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-8" style="margin-top: 20px;">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-9">
                            <div>Trips (trips.txt)</div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                	Trajetos das rotas. Sequencia de uma ou mais paradas que ocorrem em um determinado horário.
                    <BR><a href="{!! URL::to('/export/file/trips') !!}" target="_blank">Download</a>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-8" style="margin-top: 20px;">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-9">
                            <div>Stop Times (stop_times.txt)</div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                	Horário que os veículos chegam e saem das paradas em cada trajeto.
                    <BR><a href="{!! URL::to('/export/file/stoptimes') !!}" target="_blank">Download</a>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-8" style="margin-top: 20px;">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-9">
                            <div>Calendars (calendar.txt)</div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                	Datas para que o os trajetos funcionem semanalmente. Inclui data de início e término de funcionamento, bem como os dias da semana em que estão disponíveis.
                    <BR><a href="{!! URL::to('/export/file/calendar') !!}" target="_blank">Download</a>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-8" style="margin-top: 20px;">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-9">
                            <div>Shapes (shapes.txt)</div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                	Regras para desenhar linhas no mapa para representar a rotas de trânsito da organização.
                    <BR><a href="{!! URL::to('/export/file/shapes') !!}" target="_blank">Download</a>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
</div>
@stop
