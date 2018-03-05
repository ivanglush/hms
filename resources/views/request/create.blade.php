@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Изменение заявки</div>
                    <div class="panel-body">
                        <form action="/requests" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="start_date" class="control-label">Дата начала</label>
                                <input id="start_date" type="date" class="form-control" name="start_date" value="{{ old('start_date') }}">
                            </div>
                            <div class="form-group">
                                <label for="end_date" class="control-label">Дата окончания</label>
                                <input id="end_date" type="date" class="form-control" name="end_date" value="{{ old('end_date') }}">
                            </div>
                            <div class="form-group">
                                <label for="comment" class="control-label">Комментарий</label>
                                <input id="comment" type="text" class="form-control" name="comment" value="{{ old('comment') }}">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-info" type="submit">Создать</button>
                            </div>
                        </form>
                        @if($errors->any())
                            <ul class="alert alert-danger">
                                @foreach($errors->all() as  $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
