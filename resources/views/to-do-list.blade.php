<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

</head>
<body>

<div class="container">
    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Task</th>
                        <th scope="col">Level</th>
                        <th scope="col">Estimated Duration</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                        {{ $loopCount = 0; }}
                    @endphp
                    @foreach($toDoProvider1 as $key => $toDoProvider1)
                        <tr>
                            <td>{{ ++$loopCount }}</td>
                            <td>{{ $toDoProvider1->getTask() }}</td>
                            <td>{{ $toDoProvider1->getLevel() }}</td>
                            <td>{{ $toDoProvider1->getEstimatedDuration() }}</td>
                        </tr>
                    @endforeach
                    @foreach($toDoProvider2 as $toDoProvider2)
                        <tr>
                            <td>{{ ++$loopCount }}</td>
                            <td>{{ $toDoProvider2->getTask() }}</td>
                            <td>{{ $toDoProvider2->getLevel() }}</td>
                            <td>{{ $toDoProvider2->getEstimatedDuration() }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</body>
</html>
