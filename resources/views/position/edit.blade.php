@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Изменение должности</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/positions/update') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="position_id" value="{{$position->id}}">
                            <div class="form-group">
                                <label for="position_name" class="col-md-4 control-label">Должность</label>
                                <div class="col-md-6">
                                    <input id="position_name" type="text" class="form-control" name="position_name"
                                           value="{{$position->position_name}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="position_name_case" class="col-md-4 control-label">Должность в родительном падеже</label>
                                <div class="col-md-6">
                                    <input id="position_name_case" type="text" class="form-control" name="position_name_case"
                                           value="{{ $position->position_name_case }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button class="btn btn-info" type="submit">Изменить</button>
                                </div>
                            </div>
                        </form>
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
