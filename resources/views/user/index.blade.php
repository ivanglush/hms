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
                    <div id="myModal" class="modal fade">
                        <div class="modal-dialog>">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X
                                    </button>
                                    <h4 class="modal-title">Блокировка пользователя</h4>
                                </div>
                                <div class="modal-body">
                                    <form action="users/block" method="POST">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <input type="hidden" name="user_id" value="{{$user->id}}">
                                            @if($user->is_blocked)
                                                <p>Вы уверены, что хотите разблокировать пользователя?</p>
                                                <button class="btn btn-info" type="submit">Разблокировать</button>
                                            @else
                                                <label for="blocked_description" class="control-label">Причина
                                                    блокировки</label>
                                                <input id="blocked_description" type="text" class="form-control"
                                                       name="blocked_description">
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-danger" type="submit">Заблокировать</button>
                                            @endif
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection