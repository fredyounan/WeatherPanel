@extends('layouts.master')

@section('content')
            <div class="row">
                <h1>Top 10 Latitudes With Highest Temperatures</h1>
                <h4>Southern Hemisphere Only <small class="pull-right">{{ date('d-m-Y') }}</small></h4>
                
                <hr />
                
@if (! empty($temperatures))
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Latitude</th>
                            <th>Heat-index corrected temperature</th>
                        </tr>
                    </thead>
                    
                    <tbody>
    @foreach ($temperatures as $latitude => $temperature) 
                        <tr>
                            <td>{{ $latitude }}</td>
                            <td>{{ $temperature }}</td>
                        </tr>
    @endforeach
                    
                    </tbody>
                </table>
@else
                <p>No data for today :-)</p>
@endif
            </div>
@stop