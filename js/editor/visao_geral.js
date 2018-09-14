function listarShapesDaLinha(){
  var route_id = $("[name='route_id']").val();
	var caminho = $('meta[name="base_url"]').attr('content') + "/painel/route/allTrips/" + route_id;

  $.get(caminho, function(res){
    var auxList = [];
    var idAtual = res[0].trip_id;

		$(res).each(function(key,value){
      if (value.trip_id == idAtual){
        idAtual = value.trip_id;
        auxList.push(new L.LatLng(value.shape_pt_lat, value.shape_pt_lon));
      } else {
        new L.polyline(auxList, {color: colorLine}).addTo(layerVisaoGeral);
        idAtual = value.trip_id;
        auxList = [];
        auxList.push(new L.LatLng(value.shape_pt_lat, value.shape_pt_lon));
      }
		});

    new L.polyline(auxList, {color: colorLine}).addTo(layerVisaoGeral);
	});
}

function listarStopsDaLinha(){
	var route_id = $("[name='route_id']").val();
	var caminho = $('meta[name="base_url"]').attr('content') + "/painel/route/allStops/" + route_id;

  $.get(caminho, function(res){
		$(res).each(function(key,value){
			new L.marker([value.stop_lat, value.stop_lon], {icon: busIcon}).bindPopup(
				"<center><b><font size='3'>" + value.stop_name + "</font></b></center>" +
        "<center><b><font size='2'>" + value.trip_short_name + "</font></b></center>"
				).addTo(layerVisaoGeral);
		});
	});
}

function carregarElementosVisaoGeral(){
  layerVisaoGeral.clearLayers();
  listarStopsDaLinha();
  listarShapesDaLinha();
}
