@extends('layouts.app')
@section('content')
<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Address</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @if (isset($hospitals) && $hospitals -> count() > 0)
            @foreach($hospitals as $hospital)

            <tr>
                <th scope="row">{{$hospital->id}}</th>
                <td>{{$hospital->name}}</td>
                <td>{{$hospital->address}}</td>
                <td>
                    <a href="{{route('hospital.doctors',$hospital->id)}}" class="btn btn-success me-1">Show Doctors</a>
                    <a href="{{route('hospital.delete',$hospital->id)}}" class="btn btn-danger me-1">Delete Hospital</a>
                    

                </td>

            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>
@stop