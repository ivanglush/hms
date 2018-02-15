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
                                </tr>
                                @endforeach
                    </table>
                    <a href="#createRequest" class="btn btn-info" data-toggle="modal">Создать</a>
                </div>
            </div>
        </div>
    </div>

    <div id="createRequest" class="modal fade">
        <div class="modal-dialog>">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X
                    </button>
                    <h4 class="modal-title">Создание заявки</h4>
                </div>
                <div class="modal-body">
                    <form action="requests" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="start_date" class="control-label">Дата начала</label>
                            <input id="start_date" type="date" class="form-control" name="start_date">
                        </div>
                        <div class="form-group">
                            <label for="end_date" class="control-label">Дата окончания</label>
                            <input id="end_date" type="date" class="form-control" name="end_date">
                        </div>
                        <div class="form-group">
                            <label for="comment" class="control-label">Комментарий</label>
                            <input id="comment" type="text" class="form-control" name="comment">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-info" type="submit">Создать</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection