@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Изменение параметров системы</div>
                    <div class="panel-body">

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/system_parameters') }}">
                            {{ csrf_field() }}
                            @foreach($systemParameters as $parameter)
                                <div class="form-group">
                                <label for="{{$parameter->name}}"
                                       class="col-md-5 control-label">
                                    @if($parameter->name==\App\Enums\SystemParameters::ORGANISATION_NAME)
                                        Название организации:
                                    @elseif($parameter->name==\App\Enums\SystemParameters::DIRECTOR_FULL_NAME)
                                        Директор:
                                    @elseif($parameter->name==\App\Enums\SystemParameters::MAX_HOLIDAY_DURATION)
                                        Максимальная длительность отпуска:
                                    @elseif($parameter->name==\App\Enums\SystemParameters::MIN_HOLIDAY_DURATION)
                                        Минимальная длительность отпуска:
                                    @endif
                                </label>
                                <div class="col-md-6">
                                    <input id="{{$parameter->name}}" type="text" class="form-control"
                                           name="{{$parameter->name}}"
                                           value="{{$parameter->value}}">
                                </div>
                                </div>
                            @endforeach
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-5">
                                    <button type="submit" class="btn btn-primary">
                                        Изменить
                                    </button>
                                </div>
                            </div>
                        </form>
                        @if($errors->any())
                            <ul class="alert alert-danger">
                                @foreach($errors->all() as  $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
