@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Редактирование пользователя</div>
                    <div class="panel-body">

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/users') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="full_name" class="col-md-4 control-label">ФИО</label>
                                <div class="col-md-6">
                                    <input id="full_name" type="text" class="form-control" name="full_name"
                                           value="{{$user->full_name}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="full_name_case" class="col-md-4 control-label">ФИО в род. падеже</label>
                                <div class="col-md-6">
                                    <input id="full_name" type="text" class="form-control" name="full_name_case"
                                           value="{{$user->full_name_case}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">Email</label>
                                <div class="col-md-6">
                                    <input id="email" type="text" class="form-control" name="email"
                                           value="{{$user->email}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address" class="col-md-4 control-label">Адрес</label>
                                <div class="col-md-6">
                                    <input id="address" type="text" class="form-control" name="address"
                                           value="{{$user->address}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="position_id" class="col-md-4 control-label">Должнсть</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="position_id">
                                        @foreach ($positions as $position)
                                            <option value="{{ $position->id }}"
                                                    @if($position->id==$user->position_id)
                                                    selected
                                                    @endif
                                            > {{ $position->position_name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="position_id" class="col-md-4 control-label">Роль</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="role">
                                        @foreach ($roles as $role)
                                            <option value="{{$role }}"
                                                    @if($role==$user->role)
                                                    selected
                                                    @endif
                                            > {{ $role }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <input type="hidden" name="user_id" value="{{$user->id}}">
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
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
