@extends("layout.main")

<?php $message=Session::get('message')?>

@section("conteudo-pagina")
<div id="conteudo-pagina">
        <p id="titulo-pagina">Registrar-se</p>

        @include('alerts.error_validation')
        @include('alerts.success_message')

        {!!Form::open(['route'=>'user.store', 'method'=>'POST'])!!}
            <BR>
            {!!Form::label('name','Nome de usuário:', ['class'=>'form-label'])!!}<BR>
            {!!Form::text('nome',null,['class'=>'form-input','placeholder'=>'Informe seu nome de usuário'])!!}
            <BR><BR>
            {!!Form::label('email','E-mail:', ['class'=>'form-label'])!!}<BR>
            {!!Form::text('e-mail',null,['class'=>'form-input','placeholder'=>'Informe seu endereço de e-mail'])!!}
            <BR><BR>
            {!!Form::label('password1','Senha:', ['class'=>'form-label'])!!}<BR>
            {!!Form::password('senha',['class'=>'form-input','placeholder'=>'Informe sua senha'])!!}
            <BR><BR>
            {!!Form::label('password2','Confirmar senha:', ['class'=>'form-label'])!!}<BR>
            {!!Form::password('confirmar_senha',['class'=>'form-input','placeholder'=>'Re-digite a senha'])!!}
            <BR><BR><BR>
	        {!!Form::submit('Registrar',['class'=>'form-btn'])!!}
	    {!!Form::close()!!}

</div>
@stop

