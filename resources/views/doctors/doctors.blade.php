@extends('layouts.app')
@section('content')
<div class="container">

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Title</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @if (isset($doctors) && $doctors -> count() > 0)
            @foreach($doctors as $doctor)
            <tr>
                <th scope="row">{{$doctor->id}}</th>
                <td>{{$doctor->name}}</td>
                <td>{{$doctor->title}}</td>
                <td>
                    <a href="{{route('doctor.services',$doctor->id)}}" class="btn btn-primary me-1">Services</a>
                </td>

            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>
@stop