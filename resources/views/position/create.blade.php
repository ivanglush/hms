@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Добавление должности</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/positions') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="position_name"
                                       class="col-md-4 control-label">Должность</label>
                                <div class="col-md-6">
                                    <input id="position_name" type="text" class="form-control"
                                           name="position_name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="position_name_case"
                                       class="col-md-4 control-label">Должность в родительном падеже</label>
                                <div class="col-md-6">
                                    <input id="position_name_case" type="text" class="form-control"
                                           name="position_name_case">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Добавить
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
