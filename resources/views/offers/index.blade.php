@extends('offers.layout')
@section('content')
@if(Session::has('status'))
<div class="alert alert-success" role="alert">
    {{Session::get('status')}}
</div>
@endif

@if(Session::has('error'))
<div class="alert alert-danger" role="alert">
    {{Session::get('error')}}
</div>
@endif

<!-- Begin add button -->
<div class="card-body">
    <a href="{{route('offers.create')}}" class="btn btn-primary">{{__('messages.add')}}</a>
    <!-- End add button -->
    <br>
    <br>
    <!-- Begin table -->
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{__('messages.offer name')}}</th>
                    <th scope="col">{{__('messages.offer price')}}</th>
                    <th scope="col">{{__('messages.offer photo')}}</th>
                    <th scope="col">{{__('messages.operations')}}</th>


                </tr>
            </thead>
            <tbody>
                @foreach($offers as $offer)
                <tr>
                    <th scope="row">{{$offer->id}}</th>
                    <td>{{$offer->name}}</td>
                    <td>{{$offer->price}}</td>
                    <td><img style="width: 200px; height: 200px;" src="{{asset('images/offers/'.$offer->photo)}}"></td>
                    <td>
                        <a href="{{route('offers.show',$offer->id)}}"
                            class="btn btn-primary">{{__('messages.view')}}</a>
                        <a href="{{route('offers.edit',$offer->id)}}"
                            class="btn btn-success">{{__('messages.update')}}</a>
                        <a href="{{route('offers.delete',$offer->id)}}"
                            class="btn btn-danger">{{__('messages.delete')}}</a>


                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    <div class="d-flex justify-content-center">
        {!! $offers -> links() !!}
    </div>
    <!-- End Table -->
</div>
@endsection
