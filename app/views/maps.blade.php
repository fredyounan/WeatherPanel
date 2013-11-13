@extends('layouts.master')

@section('content')
            <h1>African visibility</h1>
			<hr />
			<div class="row" style="margin-bottom: 25px;">
				<div class="col-md-6" id="map-canvas" style="height:500px;"></div>
				<div class="col-md-6" id="visib"><p>testjemoeder</p></div>
			</div>
			<script type="text/javascript">
            var map;
			
			var o = {{ $o }};
			function initialize() {
			  var mapOptions = {
				zoom: 3,
				center: new google.maps.LatLng(5.18805555556, 35.0936111111),
				mapTypeId: google.maps.MapTypeId.ROADMAP
			  };
			  

			  map = new google.maps.Map(document.getElementById('map-canvas'),
				  mapOptions);
				  $(o).each(function(key, value) { var marker = new google.maps.Marker({
				  position: new google.maps.LatLng(value.latitude, value.longitude),
				  map: map,
				  title: value.name
		   });
		   
		   
		   });
			}
			
			

			google.maps.event.addDomListener(window, 'load', initialize);
            </script>
			
			
@stop