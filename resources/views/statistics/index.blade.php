@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Статистика</div>
                <div class="panel-body">
                    <div id="used_days" data-used-days="{{$usedDays}}"></div>
                    <div id="unused_days" data-unused-days="{{$unusedDays}}"></div>
                    <div id="year" data-year="{{$year}}"></div>
                    <canvas id="myChart" width="800" height="400"></canvas>

                </div>
            </div>
        </div>
    </div>

@endsection