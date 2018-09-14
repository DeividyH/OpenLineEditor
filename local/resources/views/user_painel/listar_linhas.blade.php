@extends("layout.painel")

@section("conteudo-pagina")
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Todas as Linhas
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-exchange"></i> Todas as Linhas
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        @if($linhas == 'false')
            <div class="col-lg-12">
                <div class="alert alert-info alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="fa fa-info-circle"></i>  <strong>Nenhuma linha cadastrada!</strong> Cadastre uma linha <a href="{!! URL::to('/painel/route/create') !!}" class="alert-link">aqui</a>.
                </div>
            </div>
        @else
            <div class="panel panel-default">
                <!-- Table -->
                <table class="table">
                    <thead>
                        <th>#</th>
                        <th>Agência</th>
                        <th>Nome abreviado</th>
                        <th>Nome completo</th>
                        <th></th>
                    </thead>
                    @foreach ($linhas as $linha)
                        <tr class="inline">
                            <td>{{$linha->route_id}}</td>
                            <td>{{$linha->agency_name}}</td> 
                            <td>{{$linha->route_short_name}}</td>
                            <td>{{$linha->route_long_name}}</td>
                            <td>
                                {!! link_to_route('painel.route.edit', $title = 'Editar', $parameters = $linha->route_id, $attributes = ['class'=>'btn btn-primary']) !!}
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        @endif 
    </div>
    <!-- /.row -->

</div>
<!-- /.container-fluid -->
@stop