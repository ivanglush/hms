@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Заявки на отпуск</div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Дата начала</th>
                            <th>Дата окончания</th>
                            <th>Комментарий</th>
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
                                    <td>{{$request->start_date}}</td>
                                    <td>{{$request->end_date}}</td>
                                    <td>{{$request->comment}}</td>
                                    <td>{{$request->created_at}}</td>
                                    <td>
                                        @if($request->request_state=='waiting_for_response')
                                            <form action="requests/delete" method="POST">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="request_id" value="{{$request->id}}">
                                                <a class="btn btn-default btn-block"
                                                   href="requests/edit/{{$request->id}}"
                                                   role="button">Изменить</a>
                                                <button class="btn btn-danger btn-block" type="submit">Удалить</button>
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