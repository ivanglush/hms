@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Параметры системы</div>

                    <div class="panel-body">
                        @foreach($systemParameters as $parameter)
                            <p>{{$parameter->name}}: {{$parameter->value}}</p>
                        @endforeach
                        <a class="btn btn-default pull-right" href="system_parameters/edit" >Изменить</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
