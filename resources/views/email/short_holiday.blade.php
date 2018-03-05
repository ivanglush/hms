<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
</head>
<body>
@if($emailTo==\App\Enums\Roles::LEADER)
    <p>Суммарная годовая длительность отпусков сотрудника {{$url}} меньше минимальной.</p>
@elseif($emailTo==\App\Enums\Roles::EMPLOYEE)
    <p>Ваша суммарная годовая длительность отпусков {{$url}} меньше минимальной.</p>
@endif
</body>
</html>