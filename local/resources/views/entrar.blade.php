@extends("layout.main")

<?php $message=Session::get('message')?>

@section("conteudo-pagina")
<div id="conteudo-pagina">
        <p id="titulo-pagina">Entrar</p>

        @include('alerts.error_validation')
        @include('alerts.error_message')

        {!!Form::open(['route'=>'login.store', 'method'=>'POST'])!!}
            <BR>
            {!!Form::label('email','E-mail:', ['class'=>'form-label'])!!}<BR>
            {!!Form::text('e-mail',null,['class'=>'form-input','placeholder'=>'Informe seu endereço de e-mail'])!!}
            <BR><BR>
            {!!Form::label('password1','Senha:', ['class'=>'form-label'])!!}<BR>
            {!!Form::password('senha',['class'=>'form-input','placeholder'=>'Informe sua senha'])!!}
            <BR><BR><BR>
	        {!!Form::submit('Entrar',['class'=>'form-btn'])!!}
	    {!!Form::close()!!}
</div>
@stop