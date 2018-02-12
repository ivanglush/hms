@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">Должности</div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        @foreach($positions as $position)
                            <tr>
                                <td>{{$position->position_name}}</td>
                                <td>{{$position->position_name_case}}</td>
                                <td>
                                    <form action="positions/delete" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="position_id" value="{{$position->id}}">
                                        <button class="btn btn-danger" type="submit">Удалить</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <a class="btn btn-default pull-right" href="positions/create">Добавить</a>
                </div>
            </div>
        </div>
    </div>
@endsection