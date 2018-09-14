//	INICIALIZACOES
var map = L.map('map').setView([-21.786, -46.566], 16);
var map_visao_geral = L.map('map2').setView([-21.786, -46.566], 16);

L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
	attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
	attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map_visao_geral);

var geocoder = L.control.geocoder('search-xYwVRwA').addTo(map);
var geocoder2 = L.control.geocoder('search-xYwVRwA').addTo(map_visao_geral);
var url_images = $('meta[name="base_url"]').attr('content') + "/images/";
var eventoAtivo = null;
$("#form-novo-trajeto").hide();
$("#form-novo-horario").hide();
$("#form-novo-ponto").hide();

var shapesPoints = [];
var shapesMarkers = [];
var linha = new L.Polyline(shapesPoints);
var colorLine = "#3498db";
var exibirShapesMarkers = true;

var stopMarkers = [];
var iniciouCriacaoPonto = false;

map_visao_geral.invalidateSize(false);
var layerVisaoGeral = L.layerGroup().addTo(map_visao_geral);
carregarElementosVisaoGeral();
//	FIM DAS INICIALIZACOES

var busIcon = L.icon({
    iconUrl: url_images + 'bus-marker-icon.png',
    shadowUrl: url_images + 'marker-shadow.png',

    iconSize:     [25, 41], // size of the icon
    shadowSize:   [41, 41], // size of the shadow
    iconAnchor:   [12, 40], // point of the icon which will correspond to marker's location
    shadowAnchor: [12, 40],  // the same for the shadow
    popupAnchor:  [0, -45] // point from which the popup should open relative to the iconAnchor
});

var drawIcon = L.icon({
    iconUrl: url_images + 'draw-icon.png',

    iconSize:     [15, 15], // size of the icon
    iconAnchor:   [8, 8], // point of the icon which will correspond to marker's location
    popupAnchor:  [0, -45] // point from which the popup should open relative to the iconAnchor
});

//EVENTO BOTAO ESQUERDO DO MOUSE NO MAPA
map.on('click', function(e) {
	if ($("#trajetos-cadastrados").val() != null){
	switch(eventoAtivo)
		{
			case "draw":
				if (exibirShapesMarkers){
					shapesMarkers.push( new L.marker([e.latlng.lat, e.latlng.lng], {icon: drawIcon}).addTo(map));
				}
				else {
					shapesMarkers.push( new L.marker([e.latlng.lat, e.latlng.lng], {icon: drawIcon}));
				}

				adicionarShape(e.latlng.lat, e.latlng.lng);
				shapesPoints.push(new L.LatLng(e.latlng.lat, e.latlng.lng));

				if (shapesPoints.length > 1){
					deletarLinhaDesenhada();
					desenharLinha();
				}
				break;
			case "stop":
				prepararFormularioNovoPonto(e.latlng.lat, e.latlng.lng);
				break;
			default:
		}
	}
});

//EVENTO BOTAO DIREITO DO MOUSE NO MAPA
map.on('contextmenu', function(e) {
    switch(eventoAtivo)
	{
		case "draw":
			if (shapesMarkers.length > 0){
		    	deletarShape();
		    	map.removeLayer(shapesMarkers.pop());
		    	shapesPoints.pop();
		    	deletarLinhaDesenhada();
		    	desenharLinha();
		    }
			break;
		case "stop":
			break;
		default:
	}
});

$(document).keypress(function(e){
	if(e.wich == 80 || e.keyCode == 80 || e.wich == 112 || e.keyCode == 112){
		if (exibirShapesMarkers == true){
			shapesMarkers.forEach(function(marker){
				map.removeLayer(marker);
			});
			exibirShapesMarkers = false;

		}
		else {
			shapesMarkers.forEach(function(marker){
				marker.addTo(map);
			});
			exibirShapesMarkers = true;
		}
	}
});

function deletarLinhaDesenhada(){
	map.removeLayer(linha);
}

function desenharLinha(){
	linha = L.polyline(shapesPoints, {color: colorLine}).addTo(map);
}

function abreFormTrajeto(){
	$("#form-trip").toggle("blind");
	console.log($("#inputhidden").val());
}

$("#botao-novo-trajeto").click(function(){
	$("#form-novo-trajeto").toggle('blind');
});

$("#botao-novo-horario").click(function(){
	$("#form-novo-horario").toggle('blind');
});

$('#trajetos-cadastrados').change(function() {
    recuperarShapes();
    atualizarPontos();
});

$("body").on("shown.bs.tab", "#aba-trajetos", function() {
    atualizaListaDeTrajetos();
});

$("body").on("shown.bs.tab", "#aba-visao-geral", function() {
		carregarElementosVisaoGeral();
});

$("body").on("shown.bs.tab", "#aba-osm", function() {
    map.invalidateSize(false);

 	exibirShapesMarkers = true;
    atualizarSelectTrajetos();
});

$("body").on("shown.bs.tab", "#aba-horarios", function() {
    buscarTrajetos();
});

$(window).on('beforeunload', function(){
      liberarLinha();
});

$(window).on('unload', function(){
    liberarLinha();
});

function controlarEventos(controle){
	switch(controle)
	{
		case "draw":
			if(eventoAtivo == "draw"){
				eventoAtivo = null;
				$("#ligar-evento-desenho").css("background-color", "#337AB7");
			} else {
				eventoAtivo = "draw";
				$("#ligar-evento-ponto").css("background-color", "#337AB7");
				$("#ligar-evento-desenho").css("background-color", "#286090");
			}
			break;
		case "stop":
			if(eventoAtivo == "stop"){
				eventoAtivo = null;
				$("#ligar-evento-ponto").css("background-color", "#337AB7");
			} else {
				eventoAtivo = "stop";
				$("#ligar-evento-desenho").css("background-color", "#337AB7");
				$("#ligar-evento-ponto").css("background-color", "#286090");
			}
			break;
		default:
	}
}
