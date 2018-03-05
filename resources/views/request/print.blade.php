<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link href="/css/app.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-offset-7">
            <p>Директору {{$system_parameters->where('name','organisation_name')->first()->value}}</p>
            <p>{{$system_parameters->where('name','director_full_name')->first()->value}}</p>
            <p>{{$user->position->position_name_case}}</p>
            <p>{{$user->full_name_case}}</p>
        </div>
        <div class="col-sm-offset-5">
            <p>ЗАЯВЛЕНИЕ</p>
        </div>
        <div class="col-sm-offset-1">
            <p>Прошу предоставить очередной отпуск сроком {{$duration}} дней
                с {{Carbon\Carbon::parse($request->start_date)->format('d.m.Y')}}.</p>
            <p>{{ $current_date->format('d.m.Y') }}</p>
        </div>
        <div class="col-sm-offset-7">
            Подпись
        </div>
    </div>
</div>

</body>
</html>