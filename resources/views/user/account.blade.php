@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Личный кабинет</div>
                    <div class="panel-body">
                        <p>
                            <label>ФИО: </label> {{$user->full_name}}
                        </p>
                        <p>
                            <label>ФИО в род. падеже: </label> {{$user->full_name_case}}
                        </p>
                        <p>
                            <label>Email: </label> {{$user->email}}
                        </p>
                        <p>
                            <label>Должность: </label> {{$user->position->position_name}}
                        </p>
                        <p>
                            <label>Роль: </label> {{$user->role}}
                        </p>

                        <a class="btn btn-default" href="users/edit/{{$user->id}}">Изменить</a>
                        <a class="btn btn-default" href="account/password">Изменить пароль</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection