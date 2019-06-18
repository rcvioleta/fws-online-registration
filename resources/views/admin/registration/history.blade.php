<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$event->event_name . '-' . $event->date }}</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <style>
        @media print {
            #button-helpers {
                display: none;   
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="mt-3 mb-3" id="button-helpers">
            <a href="{{ route('event.index') }}" class="btn btn-md btn-secondary">Go Back</a>
            <a href="" onclick="javascript:void(0); window.print()" class="btn btn-md btn-primary">Print Report</a>
        </div>
        <div class="card mb-4">
            <div class="card-header">Summary of Attendance</div>
            <div class="card-body">
                <h4>Percentage: {{ $attendance_percentage }}</h4>
                <h4>Overall: {{ $registered }} attended out of {{ $total }} employees</h4>
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>List Number</th>
                    <th>ID Number</th>
                    <th>Full Name</th>
                    <th>Campaign/Department</th>
                    <th class="text-center">Registered</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($records as $key => $record)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$record['e_id']}}</td>
                        <td>{{$record['full_name']}}</td>
                        <td>{{$record['campaign']}}</td>
                        <td class="text-center">
                            @if ($record['status'] === 1)
                                <span class="text-success" style="font-size: 1.8em;">&#x2714;</span>
                            @else
                                <span class="text-danger" style="font-size: 1.8em;">&#x2718</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>