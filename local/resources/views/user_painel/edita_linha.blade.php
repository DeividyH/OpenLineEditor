@extends("layout.painel")

<?php $message=Session::get('message')?>

@section("conteudo-pagina")
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Editar Linha
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-level-up"></i> Editar Linha
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

    <button class="btn btn-danger btn-sm" onClick="return confirm('Desejar realmente denunciar essa linha?')">
        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Denunciar linha
    </button>

    <ul class="nav nav-tabs" style="margin-top: 10px;">
      <li class="active"><a data-toggle="tab" href="#home" id="aba-visao-geral">Visão geral da linha</a></li>
      <li><a data-toggle="tab" href="#menu1">Editar informações da linha</a></li>
      <li><a data-toggle="tab" href="#menu2" id="aba-trajetos">Gerenciar trajetos</a></li>
      <li><a data-toggle="tab" href="#menu3" id="aba-osm">Criar/desenhar pontos</a></li>
      <li><a data-toggle="tab" href="#menu4" id="aba-horarios">Gerenciar horários</a></li>
    </ul>

    <div class="tab-content">
      <div id="home" class="tab-pane fade in active" style="padding: 10px;">
        <div id="map2" style="height: 600px; width: 100%; margin-top: 10px"> </div>
      </div>

      <div id="menu1" class="tab-pane fade" style="padding: 10px;">
        {!!Form::open()!!}
            <input name="route_id" type="hidden" value="{{ $route[0]->route_id }}" />
            <div class="form-group">
                {!!Form::label('text','Agência a ser associada:')!!}
                {{ Form::select('agencia', [ ], null, ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                {!!Form::label('text','Nome abreviado da linha:')!!}
                {!!Form::text('nome_abreviado_da_linha', $route[0]->route_short_name, ['class'=>'form-control','placeholder'=>'abreviação da linha'])!!}
            </div>
            <div class="form-group">
                {!!Form::label('text','Nome completo da linha:')!!}
                {!!Form::text('nome_completo_da_linha', $route[0]->route_long_name, ['class'=>'form-control','placeholder'=>'nome da linha'])!!}
            </div>
            <div class="form-group">
                {!!link_to('#', $title = 'Salvar', $attributes = ['id' =>'salva-info-linha', 'class'=>'btn btn-primary'])!!}
            </div>
        {!!Form::close()!!}
      </div>

      <div id="menu2" class="tab-pane fade" style="padding: 10px;">

        <button id="botao-novo-trajeto" class="btn btn-primary">Novo trajeto</button>

        <div id="form-novo-trajeto" class="panel panel-default" style="padding: 10px; margin-top:10px;">
            {!!Form::open()!!}
                <div id="form-group-trip-name" class="form-group">
                    {!!Form::label('text','Nome do trajeto:')!!}
                    {!!Form::text('nome_do_trajeto', null, ['class'=>'form-control','placeholder'=>'nome do trajeto'])!!}
                </div>
                <div class="form-group">
                    {!!Form::label('text','Dias de funcionamento:')!!}
                    <div class="form-inline">
                        {{ Form::checkbox('segunda', '1') }} segunda

                        {{ Form::hidden('terca', '0') }}
                        {{ Form::checkbox('terca', '1') }} terça

                        {{ Form::hidden('quarta', '0') }}
                        {{ Form::checkbox('quarta', '1') }} quarta

                        {{ Form::hidden('quinta', '0') }}
                        {{ Form::checkbox('quinta', '1') }} quinta

                        {{ Form::hidden('sexta', '0') }}
                        {{ Form::checkbox('sexta', '1') }} sexta

                        {{ Form::hidden('sabado', '0') }}
                        {{ Form::checkbox('sabado', '1') }} sábado

                        {{ Form::hidden('domingo', '0') }}
                        {{ Form::checkbox('domingo', '1') }} domingo
                    </div>
                </div>
                <div id="form-group-trip-start-date" class="form-group">
                    {!!Form::label('local','Início do funcionamento do serviço:')!!}
                    {!!Form::date('data_de_inicio', \Carbon\Carbon::now(), ['class'=>'form-control'])!!}
                </div>
                <div id="form-group-trip-departure-date" class="form-group">
                    {!!Form::label('local','Término do funcionamento do serviço:')!!}
                    {!!Form::date('data_de_termino', \Carbon\Carbon::now()->addYears(1), ['class'=>'form-control'])!!}
                </div>
                {!!link_to('#', $title = 'Cadastrar', $attributes = ['id' =>'registra-novo-trajeto', 'class'=>'btn btn-primary'])!!}
            {!!Form::close()!!}
        </div>

        <table id="trips-table" class="table">
            <thead>
                <th>#</th>
                <th>Nome do trajeto</th>
                <th>Disponibilidade</th>
                <th>Data de início</th>
                <th>Data de fim</th>
                <th></th>
            </thead>
            <tbody class="inline">
            </tbody>
        </table>
      </div>

        <div id="menu3" class="tab-pane fade" style="padding: 10px;">

        <div class="form-group">
            {!!Form::label('text','Trajeto selecionado:')!!}
            <select id="trajetos-cadastrados" class="form-control">
            </select>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <center>
                        <div class="btn-group" role="group" aria-label="...">
                            <button id="ligar-evento-desenho" type="button" class="btn btn-primary" onClick="controlarEventos('draw')">
                                <i class="fa fa-paint-brush" aria-hidden="true"></i> Desenhar Trajeto
                            </button>
                            <button id="ligar-evento-ponto" type="button" class="btn btn-primary" onClick="controlarEventos('stop')">
                                <i class="fa fa-bus" aria-hidden="true"></i> Adicionar Ponto
                            </button>
                        </div>
                    </center>
                </div>
            </div>
        </div>

        <div id="form-novo-ponto" class="panel panel-default" style="padding: 10px; margin-top:10px;">
            {!!Form::open()!!}
                <div class="form-group">
                    {!!Form::label('text','Nome do ponto:')!!}
                    {!!Form::text('nome_do_ponto', null, ['class'=>'form-control','placeholder'=>'nome do ponto'])!!}
                </div>
                <div class="form-group">
                    {!!Form::label('text','Latitude:')!!}
                    {!!Form::text('latitude_do_ponto', null, ['class'=>'form-control', 'disabled'])!!}
                </div>
                <div class="form-group">
                    {!!Form::label('text','Longitude:')!!}
                    {!!Form::text('longitude_do_ponto', null, ['class'=>'form-control', 'disabled'])!!}
                </div>

                <button class="btn btn-primary" onClick="return adicionarStop()">
                    Cadastrar
                </button>

                <button class="btn btn-danger" onClick="return cancelarPonto()">
                    <span class="fa fa-trash" aria-hidden="true"></span>
                </button>
            {!!Form::close()!!}
        </div>

        <div id="map" style="height: 600px; width: 100%; margin-top: 10px"> </div>
        </div>

        <div id="menu4" class="tab-pane fade" style="padding: 10px;">
            <div class="form-group">
                {!!Form::label('text','Trajeto selecionado:')!!}
                <select id="form-novo-horario-trajetos" class="form-control"></select>
            </div>
            <div class="form-group">
                {!!Form::label('text','Ponto de parada selecionado:')!!}
                <select id="form-novo-horario-paradas" class="form-control"></select>
            </div>
        
            <button id="botao-novo-horario" class="btn btn-primary">Novo horário</button>

            <div id="form-novo-horario" class="panel panel-default" style="padding: 10px; margin-top:10px;">
                {!!Form::open()!!}
                    <div class="form-group">
                        {!!Form::label('local','Hora de chegada no ponto de parada:')!!}
                        {!!Form::time('hora_de_chegada', null, ['class'=>'form-control'])!!}
                    </div>
                    <div class="form-group">
                        {!!Form::label('local','Hora de partida no ponto de parada:')!!}
                        {!!Form::time('hora_de_partida', null, ['class'=>'form-control'])!!}
                    </div>

                    <button class="btn btn-primary" onClick="return adicionarStopTime()">
                        Cadastrar
                    </button>
                {!!Form::close()!!}
            </div>

            <table id="stoptimes-table" class="table">
                <thead>
                    <th>#</th>
                    <th>Hora de chegada</th>
                    <th>Hora de partida</th>
                    <th></th>
                </thead>
                <tbody class="inline">
                </tbody>
            </table>
        </div>
    </div>

    {!! Html::script("js/editor/visao_geral.js") !!}
    {!! Html::script("js/editor/agency.js") !!}
    {!! Html::script("js/editor/route.js") !!}
    {!! Html::script("js/editor/trip.js") !!}
    {!! Html::script("js/editor/shape.js") !!}
    {!! Html::script("js/editor/stop.js") !!}
    {!! Html::script("js/editor/stop_time.js") !!}
    {!! Html::script("js/edita_linha.js") !!}

</div>
<!-- /.container-fluid -->
@stop
