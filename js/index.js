window.onload = function(){
	var map = L.map('map').setView([-21.786, -46.566], 16);

	L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
		attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
	}).addTo(map);

	var geocoder = L.control.geocoder('search-xYwVRwA').addTo(map);
	var busIcon = L.icon({
	    iconUrl: 'images/bus-marker-icon.png',
	    shadowUrl: 'images/marker-shadow.png',

	    iconSize:     [25, 41], // size of the icon
	    shadowSize:   [41, 41], // size of the shadow
	    iconAnchor:   [12, 40], // point of the icon which will correspond to marker's location
	    shadowAnchor: [12, 40],  // the same for the shadow
	    popupAnchor:  [0, -45] // point from which the popup should open relative to the iconAnchor
	});

	map.on('click', function(e) {
		//L.marker([e.latlng.lat, e.latlng.lng], {icon: busIcon}).addTo(map)
		//.bindPopup('A pretty CSS3 popup.<br> Easily customizable.')
    	//.openPopup();

    	console.log("lat: " + e.latlng.lat);
    	console.log("long: " + e.latlng.lng);
	});

	/*
	var http = require('http');

	http.createServer(function (req, res) {
	  res.setHeader('Access-Control-Allow-Origin','*');
	  res.writeHead(200, {'Content-Type': 'text/plain'});
	  res.end("Hello World");
	}).listen();
	*/
	/*
	$.ajax({
	    //url: 'http://gtfs-nodejsgtfs.rhcloud.com/',
	    url: 'http://localhost:8000/',
	    dataType: 'text',
	    data: "age=20", 
	    crossDomain: true,
	    type: 'GET',
	    success: function (data) {
	        obj = JSON.parse(data);
	        //alert(obj.employees[1].firstName);
	    }
	});
	*/
	
}