@extends("layout.painel")

<?php $message=Session::get('message')?>

@section("conteudo-pagina")
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Cadastrar Empresa
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-fw fa-edit"></i> Cadastrar Empresa
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            @include('alerts.error_validation')
            @include('alerts.success_message')

            {!!Form::open(['route'=>'painel.agency.store', 'method'=>'POST'])!!}
                <div class="form-group">
                    {!!Form::label('nome','Nome da empresa:')!!}
                    {!!Form::text('nome_da_empresa', null, ['class'=>'form-control','placeholder'=>'empresa'])!!}
                </div>
                <div class="form-group">
                    {!!Form::label('site','Site:')!!}
                    {!!Form::text('site_da_empresa', null, ['class'=>'form-control','placeholder'=>'ex: http://site.com.br'])!!}
                </div>
                <div class="form-group">
                    {!!Form::label('local','Localização:')!!}
                    {{ Form::select('localizacao', [
                        'DE' => 'Alemanha',
                        'BR' => 'Brasil',
                        'CA' => 'Canada',
                        'US' => 'Estados Unidos',
                        'PT' => 'Portugal'],
                        null, ['class' => 'form-control']
                    ) }}
                </div>

                {!!Form::submit('Cadastrar',['class'=>'btn btn-primary'])!!}
            {!!Form::close()!!}
        </div>
    </div>
    <!-- /.row -->

    <BR>
</div>
<!-- /.container-fluid -->
@stop