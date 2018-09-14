@extends("layout.painel")

<?php $message=Session::get('message')?>

@section("conteudo-pagina")
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Cadastrar Linha
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-level-up"></i> Cadastrar Linha
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            @include('alerts.error_validation')
            @include('alerts.success_message')

            {!!Form::open(['route'=>'painel.route.store', 'method'=>'POST'])!!}
                <div class="form-group">
                    {!!Form::label('agenc','Agência a ser associada:')!!}

                    <select name="agencia" class="form-control">
                        @foreach($agencies as $agency)
                        <option value="{{$agency->agency_id}}">{{$agency->agency_name . ' ('.$agency->agency_timezone.')'}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    {!!Form::label('nome','Nome abreviado da linha:')!!}
                    {!!Form::text('nome_abreviado_da_linha', null, ['class'=>'form-control','placeholder'=>'abreviação da linha'])!!}
                </div>
                <div class="form-group">
                    {!!Form::label('site','Nome completo da linha:')!!}
                    {!!Form::text('nome_completo_da_linha', null, ['class'=>'form-control','placeholder'=>'nome da linha'])!!}
                </div>

                <BR>
                {!!Form::submit('Cadastrar',['class'=>'btn btn-primary'])!!}
            {!!Form::close()!!}
        </div>
    </div>
    <!-- /.row -->

    <BR>

</div>
<!-- /.container-fluid -->
@stop
