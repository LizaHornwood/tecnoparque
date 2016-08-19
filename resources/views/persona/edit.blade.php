@extends('layouts.headerFooter')
@include ('layouts.menuHeader')
@include ('layouts.scripts')

@section('content')

{!!Form::model($persona,['route'=> ['persona.update',$persona->idPersona],'method'=>'PUT'])!!}

	<div class="container" >

		<div>
		<br><br>
		 	{!!link_to_route('persona.index', $title = '', null, $attributes = 	['class'=>'btn btn-warning glyphicon glyphicon-arrow-left'])!!}	
		</div>

		<div class="banner-data">

			<div class=" text-center ">
			<h1>Modificar Persona</h1>
		    </div>

		    <br>

			@include('persona.forms.persona')

			<div class="form-group ">
			{!!Form::submit('Modificar',['class'=>'btn btn-success'])!!}
			</div> 

{!!Form::close()!!}

		</div>

	</div>

@stop
