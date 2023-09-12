@extends('layouts.app')
@section('content')
<div class="container">

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">DoctorName</th>
            </tr>
        </thead>
        <tbody>
            @if (isset($services) && $services -> count() > 0)

            @foreach($services as $service)
            <tr>
                <th scope="row">{{$service->id}}</th>
                <td>{{$service->name}}</td>
                <td>{{$doctorName}}</td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>
@stop