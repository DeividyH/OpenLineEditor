function adicionarShape(lat, lng){
	var caminho = $('meta[name="base_url"]').attr('content') + "/painel/shape";
	var trip_id = $("#trajetos-cadastrados").val();

	$.ajax({
		url: caminho,
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		type: 'POST',
		dataType: 'json',
		data: {trip_id: trip_id, latitude: lat, longitude: lng},

		success:function(){

		},
		error:function(msj){
			//abrir alerta de falha
			console.log(msj + "");
		}
	});
}

function deletarShape(){
	var trip_id = $("#trajetos-cadastrados").val();
	var caminho = $('meta[name="base_url"]').attr('content') + "/painel/shape/" + trip_id;

	$.ajax({
		url: caminho,
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		type: 'DELETE',
		dataType: 'json',

		success:function(){

		},
		error:function(msj){
			//abrir alerta de falha
			console.log(msj + "");
		}
	});
}

function recuperarShapes(){
	var trip_id = $("#trajetos-cadastrados").val();
	var caminho = $('meta[name="base_url"]').attr('content') + "/painel/shapes/" + trip_id;

	map.removeLayer(linha);
	shapesMarkers.forEach(function(marker){
		map.removeLayer(marker);
	});

	shapesPoints = [];
	shapesMarkers = [];

	$.get(caminho, function(res){
		$(res).each(function(key,value){
			shapesPoints.push(new L.LatLng(value.shape_pt_lat, value.shape_pt_lon));
			shapesMarkers.push(new L.marker([value.shape_pt_lat, value.shape_pt_lon], {icon: drawIcon}).addTo(map));
		});

		desenharLinha();
	});
}
