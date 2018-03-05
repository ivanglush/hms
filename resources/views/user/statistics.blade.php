@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Отпуска</div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Начало отпуска</th>
                            <th>Окончание отпуска</th>
                            <th>Комментарий</th>
                        </tr>
                        @foreach($requests as $request)
                            <tr>
                                <td>{{$request->start_date}}</td>
                                <td>{{$request->end_date}}</td>
                                <td>{{$request->comment}}</td>
                            </tr>
                        @endforeach
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection