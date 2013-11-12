@extends('layouts.master')

@section('content')
            <script type="text/javascript">
            var s1 = [{{ $s1 }}];
            var ticks = ['{{ $ticks }}'];
            </script>
            
            <div id="chart1" class="span12" style="height:250px;"></div>
            
            
@stop