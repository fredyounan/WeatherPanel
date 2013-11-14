@extends('layouts.master')

@section('content')
            <script type="text/javascript">
            var s1 = [{{ $s1 }}];
            </script>
            
            <h1>{{ $graphName }} 
            @if ($s1 !== false)
            <a class="btn btn-default btn-tiny pull-right" href="{{ URL::to('/export/station/' . $stn) }}">Export</a>
            @endif
            </h1>
            
            <hr />
            
            @if ($s1 === false)
            <p class="alert alert-warning">No data found!</p>
            <p><a class="btn btn-default" href="{{ URL::to('/data/world') }}">&laquo; Back</a></p>
            @else
            <div id="chart1" style="height:250px;"></div>
            @endif
@stop