@extends('layouts.master')

@section('content')
            <script type="text/javascript">
            var s1 = [{{ $s1 }}];
            var ticks = ['{{ $ticks }}'];
            </script>
            
            <div id="chart1" style="width:600px; height:250px;"></div>
            
            
@stop