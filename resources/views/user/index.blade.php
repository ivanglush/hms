@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Пользователи</div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <tr>
                            <th><a href="/users?sort_by=full_name">ФИО</a> </th>
                            <th>ФИО в род. падеже</th>
                            <th><a href="/users?sort_by=email">Email</a></th>
                            <th>Адрес</th>
                            <th>Роль</th>
                            <th>Должность</th>
                            <th>Причина блокировки</th>
                            <th>Действия</th>
                        </tr>
                        @foreach($users as $user)
                            @if($user->is_blocked)
                                <tr class="danger">
                            @else
                                <tr>
                                    @endif
                                    <td>{{$user->full_name}}</td>
                                    <td>{{$user->full_name_case}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->address}}</td>
                                    <td>{{$user->role}}</td>
                                    <td>{{$user->position->position_name}}</td>
                                    <td>{{$user->blocked_description}}</td>
                                    <td>
                                        <div class="btn-group-vertical" role="group" aria-label="a">
                                            <a class="btn btn-default " href="users/edit/{{$user->id}}" role="button">Изменить</a>
                                            @if($user->is_blocked)
                                                <a href="/users/block/{{$user->id}}" class="btn btn-info"
                                                   data-toggle="modal">Разблокировать</a>
                                            @else
                                                <a href="/users/block/{{$user->id}}" class="btn btn-danger"
                                                   role="button"
                                                   data-toggle="modal">Заблокировать</a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                    </table>
                    {{--<a class="btn btn-default pull-right" href="users/create">Добавить</a>--}}
                    <div class="col-md-offset-5">{{$users->render()}}</div>
                    <a class="btn btn-default " href="users/create" role="button">Добавить</a>
                </div>
            </div>
        </div>
    </div>
@endsection