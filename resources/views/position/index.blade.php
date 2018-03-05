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
                                <td>  <a class="btn btn-default btn-block" role="button"
                                               href="positions/edit/{{$position->id}}">Изменить</a>
                                    <form action="positions/delete" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="position_id" value="{{$position->id}}">
                                        <button class="btn btn-danger  btn-block" type="submit">Удалить</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    @if($errors->any())
                        <ul class="alert alert-danger">
                        @foreach($errors->all() as  $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    @endif
                    <p><a class="btn btn-default pull-right" href="positions/create">Добавить</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection