@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Заявки на отпуск</div>
                <div class="panel-body">
                    <form class="form-inline ">
                        <select class="form-control" name="user_id">
                            <option value=""></option>
                            @foreach ($users as $user)
                                <option value="{{$user->id }}"
                                        @if($user->id==$selectedUser)
                                        selected
                                        @endif
                                > {{ $user->full_name }}</option>
                            @endforeach
                        </select>
                        <select class="form-control" name="state">
                            <option value=""></option>
                            @foreach ($states as $state)
                                <option value="{{$state }}"
                                         @if($selectedState==$state)
                                         selected
                                         @endif
                                > {{ $state }}</option>
                            @endforeach
                        </select>
                            <button type="submit" class="btn btn-primary">
                                Фильтровать
                            </button>
                    </form>
                    <table class="table table-bordered">
                        <tr>
                            <th>ФИО</th>
                            <th>Дата начала</th>
                            <th>Дата окончания</th>
                            <th>Комментарий</th>
                            <th>Статус</th>
                            <th>Дата подачи</th>
                            <th>Действия</th>
                        </tr>
                        @foreach($requests as $request)
                            @if($request->request_state=='accepted')
                                <tr class="success">
                            @elseif($request->request_state=='rejected')
                                <tr class="danger">
                            @elseif($request->request_state=='waiting_for_response')
                                <tr class="info">
                                    @endif
                                    <td><a href="/requests/user/{{$request->user->id}}">{{$request->user->full_name}}</a> </td>
                                    <td>{{$request->start_date}}</td>
                                    <td>{{$request->end_date}}</td>
                                    <td>{{$request->comment}}</td>
                                    <td><a href="{{request()->url()}}?state={{$request->request_state}}">{{$request->request_state}}</a></td>
                                    <td>{{$request->created_at}}</td>
                                    <td>
                                        @if($request->request_state=='waiting_for_response')
                                            <form action="/requests/state" method="POST">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="request_id" value="{{$request->id}}">
                                                <input type="hidden" name="new_state" value="accepted">
                                                <button class="btn btn-success btn-block" type="submit">Утвердить
                                                </button>
                                            </form>
                                            <form action="/requests/state" method="POST">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="request_id" value="{{$request->id}}">
                                                <input type="hidden" name="new_state" value="rejected">
                                                <button class="btn btn-danger btn-block" type="submit">Отклонить
                                                </button>
                                            </form>
                                        @elseif($request->request_state=='accepted')
                                            <a class="btn btn-default btn-block" role="button"
                                               href="requests/print/{{$request->id}}">Печать</a>
                                        @endif
                                            <a class="btn btn-default btn-block" role="button"
                                               href="requests/history/{{$request->id}}">История</a>
                                    </td>
                                </tr>
                                @endforeach
                    </table>
                    <a href="/requests/create" class="btn btn-info" data-toggle="modal">Создать</a>
                </div>
            </div>
        </div>
    </div>
@endsection