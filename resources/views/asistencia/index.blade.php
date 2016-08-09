@extends('layouts.headerFooter')

@include ('layouts.menuHeader')

@section('content')

@include ('layouts.scripts')
@include ('dataTables.scriptDataTable11')

<div class="container">

	<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="myModal">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Buscar persona</h4>
				</div>
				<div class="modal-body">
					<table id="dataTablePersona" class="table table-bordered">
						<thead>
							<tr>
								<th>id</th>
								<th>Número de identificación</th>
								<th>Tipo de documento</th>
								<th>Tipo de persona</th>
								<th>Nombres</th>
								<th>Apellidos</th>
								<th>Género</th>
								<th>Correo electrónico</th>
								<th>Teléfono</th>
								<th>Celular</th>
								<th>Empresa</th>								
								<th>Operación</th>
							</tr>
						</thead>

						<tbody>
							@foreach($personas as $persona)
								<tr>
									<td>{{$persona->idPersona}}</td>
									<td>{{$persona->numeroIdentificacion}}</td>
									<td>{{$persona->tipoDocumentos->nombre}}</td>
									<td>{{$persona->tipoPersonas->nombre}}</td>
									<td>{{$persona->nombres}}</td>
									<td>{{$persona->apellidos}}</td>
									<td>
										@if($persona->genero== 1)
										Femenino
										@elseif($persona->genero==2)
										Masculino
										@endif						
									</td>
									<td>{{$persona->correo}}</td>
									<td>{{$persona->telefono}}</td>
									<td>{{$persona->celular}}</td>
									<td>{{$persona->empresa}}</td>									
									<td> 														
										<button type="button" class="btn btn-warning" data-dismiss="modal">Agregar</button>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>					
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<br>

	<h1><center>Lista de Asistencia del evento {{$evento->nombre}}, {{$evento->fecha}}</center></h1>

	<div class="row">
		{!!Form::button('Agregar asistente', ['id'=>'btn', 'class'=>'btn btn-primary', 'data-toggle'=>'modal', 'data-target'=>'#myModal'])!!}
	</div>
	
	<div class="row">
		<table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>id</th>
					<th>Número de identificación</th>
					<th>Tipo de documento</th>
					<th>Tipo de persona</th>
					<th>Nombres</th>
					<th>Apellidos</th>
					<th>Género</th>
					<th>Correo electrónico</th>
					<th>Teléfono</th>
					<th>Celular</th>
					<th>Empresa</th>
					<th>Responsable del Evento</th>
					<th>Operación</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($evento->personas as $asistente)

				 	<tr>
				 		<td>{{$asistente->idPersona}}</td>
					 	<td>{{$asistente->numeroIdentificacion}}</td>
					 	<td>{{$asistente->tipoDocumentos->nombre}}</td>
					 	<td>{{$asistente->tipoPersonas->nombre}}</td>
						<td>{{$asistente->nombres}}</td>
						<td>{{$asistente->apellidos}}</td>
						<td>@if($asistente->genero== 1)Femenino @elseif($asistente->genero==2)Masculino @endif	
						</td>
						<td>{{$asistente->correo}}</td>
						<td>{{$asistente->telefono}}</td>
						<td>{{$asistente->celular}}</td>
						<td>{{$asistente->empresa}}</td>
						<td>
							@if($asistente->pivot->responsable== 0){!!Form::checkbox('responsable', 'value')!!}
							@else{!!Form::checkbox('responsable', 'value', true)!!}
							@endif
						</td>
						<td>									
			           	    {!!Form::button('Quitar',['class'=>'btn btn-danger quitar'])!!}
		            	</td>
	            	</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<br>
	<div class="row">
		{!!link_to("#", $title = 'Guardar cambios', $attributes = ['id'=>'guardar', 'class'=>'btn btn-primary'], $secure = null)!!}
	</div>
	<br>
	<div class="row">
        {!!link_to_route('evento.index', $title = 'Regresar', null, $attributes = ['class'=>'btn btn-success'])!!}
    </div>	
	<br>


</div>
@stop

@section('pageScripts')
	<script type="text/javascript">

	$(document).ready(function(){ 

		var tablePersona = $('#dataTablePersona').DataTable(
        {
          	// responsive:true,   //para el +
          	scrollY:        "300px",
	        scrollX:        true,
	        scrollCollapse: true,
	        paging:         false,
	        // fixedColumns:   {
	        //     leftColumns: 0,
	        //     rightColumns: 1
	        // },
			"aoColumnDefs":
			[
				{
				'bSortable': false, 'aTargets': [10]
				}
			],
			"oLanguage":
			{
				"sUrl": "../resources/lang/Espanhol.json"
			}
		});   	

		var table = $('#dataTable').DataTable(
        {
          	// responsive:true,   //para el +
          	scrollY:        "300px",
	        scrollX:        true,
	        scrollCollapse: true,
	        paging:         false,
	        // fixedColumns:   {
	        //     leftColumns: 0,
	        //     rightColumns: 1
	        // },
	        "columnDefs":
	        {
                "targets": [ 1 ],
                "visible": false,
                "searchable": false
            },
			"aoColumnDefs":
			[
				{
				'bSortable': false, 'aTargets': [11]
				}
			],
			"oLanguage":
			{
				"sUrl": "../resources/lang/Espanhol.json"
			}
		});   		

		$('#dataTablePersona tbody').on( 'click', '.btn-warning', function () {		
			var dataAsistentes = [];

			$("#dataTable tr").each(function(){
			    dataAsistentes.push($(this).find("td:first").text()); //put elements into array
			});

		    var data = tablePersona.row( $(this).parents('tr') ).data();
		    var idPersonas = data[0];		    
	    	// console.log("personas: " + data);

		    for (var i = 0; i < dataAsistentes.length; i++) {
		    	// console.log("personas: " + idPersonas + " dataAsistentes: " + dataAsistentes[i]);
		    	if (idPersonas == dataAsistentes[i]) {
		    		swal({
						title: "",
						text: "La persona escogida ya esta en este evento",
						type: "error",
						confirmButtonText: "Aceptar",
						allowOutsideClick: true
					})
		    		return false;
		    	}
		    }
		    var row = $(this).parents('tr');
		    
		    table.row.add( [
		        data[0],
		        data[1],
		        data[2],
		        data[3],
		        data[4],
		        data[5],
		        data[6],
		        data[7],
		        data[8],
		        data[9],
		        data[10],		        
				'{!!Form::checkbox('name', 'value')!!}',							
		        '<td>' + 
		        	'<button class="btn btn-danger quitar" type="button">Quitar</button>' + 
	        	'</td>'
		    ] ).draw( false );		  

		});

		$("#dataTable").on('click', '.quitar', function () {
			
		    table
	        .row( $(this).parents('tr') )
	        .remove()
	        .draw();
		});

		var $checkbox;

		$("#guardar").click(function(){

			var idEvento = '{{$evento->idEvento}}';			
			var token = $("#token").val();
			var data = [];
			var aux = 0;
			var responsable = 0;
			var idPersona;

			// data.push({
		 //      	idEvento: '{{$evento->idEvento}}',
		 //      	idPersona: '3',
		 //      	responsable: '0'
		 //    });

		 //    data.push({
		 //      	idEvento: '{{$evento->idEvento}}',
		 //      	idPersona: '1',
		 //      	responsable: '1'
		 //    });

			// data[0]["idEvento"] = '1';
			// data[0]["idPersona"] = '3';
			// data[0]["responsable"] = '0';

			// table.find('tr').each(function (rowIndex, r) {
		        
		 //        $(this).find('td').each(function (colIndex, c) {
		 //            data.push(c.textContent);
		 //        });
		 //        data.push(cols);
		 //    });

		 	$('#dataTable tbody tr').each(function(){
		 		
		 		console.log($(this).children('td:nth-last-child(2)').html());
		 				 		
		 		if ($(this).children('td:nth-last-child(2)').find('input[type="checkbox"]').prop('checked')) {
		 			console.log("chgeceged");
		 			responsable = 1;
		 		} else {
		 			responsable = 0;
		 		}		 						

		 		idPersona = $(this).children('td:first').html();
		 		if ($(this).children('td:first').html() == "No data available in table") {
		 			idPersona = null;
		 		} 

	 			data.push({
			 		idEvento: idEvento,
			      	idPersona: idPersona,
			      	responsable: responsable
				});		 		

		 		aux++;

		 	})			

			console.log(data);

			$.ajax({
            	headers: {'X-CSRF-TOKEN': token},
                type: 'POST',
                url: "../asistencia",
                data: {data: data},
                dataType: 'json', 
                success: function(data) {
	                // successmessage = 'Data was succesfully captured';
	                // $("label#successmessage").text(successmessage);
	                // var loc = window.location;
    				// window.location = "../evento";    	
    				swal(
						'Evento modificado correctamente',
						'',
						'success'
					)
	            },  
	            error: function(data) {
            		swal(
						'Ha ocurrido un erro',
						'',
						'error'
					)
	                // successmessage = 'Error';
	                // $("label#successmessage").text(successmessage);
	                // $("body").html(data);
	                // var loc = window.location;
    				// window.location = "../evento";
	            },          
            })


		})

	});	
</script>
@stop


