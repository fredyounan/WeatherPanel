@extends('layouts.master')

@section('content')
            <h1>Average visibility of Africa per week</h1>
			<h4>Average visibility is {{ $visib }}<small class="pull-right">{{ $date1 }} to {{ $date2}}</small></h4>
			<hr />
			<div class="row" style="margin-bottom: 25px;">
				<div id="map-canvas" style="height:500px;"></div>
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