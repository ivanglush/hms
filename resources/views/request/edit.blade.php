@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Изменение заявки</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/requests/update') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="request_id" value="{{$request->id}}">
                            <div class="form-group">
                                <label for="start_date" class="col-md-4 control-label">Дата начала</label>
                                <div class="col-md-6">
                                    <input id="start_date" type="date" class="form-control" name="start_date"
                                           value="{{$request->start_date}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="end_date" class="col-md-4 control-label">Дата окончания</label>
                                <div class="col-md-6">
                                    <input id="end_date" type="date" class="form-control" name="end_date"
                                           value="{{$request->end_date}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="comment" class="col-md-4 control-label">Комментарий</label>
                                <div class="col-md-6">
                                    <input id="comment" type="text" class="form-control" name="comment"
                                           value="{{$request->comment}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button class="btn btn-info" type="submit">Изменить</button>
                                </div>
                            </div>
                        </form>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
