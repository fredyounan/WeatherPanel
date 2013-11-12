@extends('layouts.master')

@section('content')
            <script type="text/javascript">
            var s1 = [{{ $s1 }}];
            var ticks = ['{{ $ticks }}'];
            </script>
            
            <div class="row">
                <h1>{{ $graphName }}</h1>
                
                <hr />
                
                <div id="chart1" style="height:250px;"></div>
            </div>
@stop