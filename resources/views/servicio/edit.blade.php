@extends('layouts.headerFooter')

@section('content')

{!!Form::model($servicio,['route'=> ['servicio.update',$servicio->idServicio],'method'=>'PUT'])!!}

	<div class="container" >

		<div class="banner-data2 col-md-8">

			<div class=" text-center ">
			<h1>Modificar Servicio</h1>
		    </div>

		    <br>

			@include('servicio.forms.servicio')

			<div class="form-group ">
			{!!Form::submit('Modificar',['class'=>'btn btn-success'])!!}
			</div> 

			<div class="clearfix"> </div>

{!!Form::close()!!}

		</div>

	</div>


@stop
