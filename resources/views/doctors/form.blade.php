@extends('layouts.app')
@section('content')


<!-- Form Begin -->
<form class="form-example" action="{{route('save.Doctor.Services')}}" method="post">
    @csrf


    <div class="form-group">
        <label for="exampleInputEmail1">Choose Doctor</label>
        <select class="form-control" name="doctor_id">
            @foreach($doctors as $doctor)
            <option value="{{$doctor -> id}}">{{$doctor -> name}}</option>
            @endforeach
        </select>

    </div>


    <div class="form-group">
        <label for="exampleInputEmail1">Choose Services </label>

        <select class="form-control" name="servicesIds[]" multiple>
            @foreach($allServices as $allService)
            <option value="{{$allService -> id}}">{{$allService -> name}}</option>
            @endforeach
        </select>

    </div>
    <button type="submit" class="btn btn-primary btn-customized mt-4">Save</button>
</form>
<!-- Form end -->
</div>
@stop