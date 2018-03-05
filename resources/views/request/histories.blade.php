@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">История статусов</div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Дата изменения</th>
                            <th>Кем произведено</th>
                            <th>Новый статус</th>
                        </tr>
                        @foreach($histories as $history)
                            <tr>
                                <td>{{$history->created_at}}</td>
                                <td>{{$history->user->full_name}}</td>
                                <td>{{$history->new_state}}</td>
                                {{--<td>{{$history->request->id}}</td>--}}
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection