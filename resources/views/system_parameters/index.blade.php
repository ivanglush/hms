@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Параметры системы</div>

                    <div class="panel-body">
                        @foreach($systemParameters as $parameter)
                            <p>
                                @if($parameter->name==\App\Enums\SystemParameters::ORGANISATION_NAME)
                                    <label>Название организации:</label>
                                @elseif($parameter->name==\App\Enums\SystemParameters::DIRECTOR_FULL_NAME)
                                    <label>Директор:</label>
                                @elseif($parameter->name==\App\Enums\SystemParameters::MAX_HOLIDAY_DURATION)
                                    <label>Максимальная длительность отпуска:</label>
                                @elseif($parameter->name==\App\Enums\SystemParameters::MIN_HOLIDAY_DURATION)
                                    <label>Минимальная длительность отпуска:</label>
                                @endif
                                {{$parameter->value}}
                            </p>
                        @endforeach
                        <a class="btn btn-default pull-right" href="system_parameters/edit">Изменить</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
