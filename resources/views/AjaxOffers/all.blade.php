@extends('layouts.app')
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
                <tr class="offerRow{{$offer->id}}">
                    <th scope="row">{{$offer->id}}</th>
                    <td>{{$offer->name}}</td>
                    <td>{{$offer->price}}</td>
                    <td><img style="width: 200px; height: 200px;" src="{{asset('images/offers/'.$offer->photo)}}"></td>
                    <td>
                        <!-- me-1 : put spaces between buttons [Bootstrap] -->
                        <a href="{{route('offers.show',$offer->id)}}"
                            class="btn btn-primary me-1">{{__('messages.view')}}</a>
                        <a href="{{route('offers.edit',$offer->id)}}"
                            class="btn btn-success me-1">{{__('messages.update')}}</a>
                        <a href="{{route('offers.delete',$offer->id)}}"
                            class="btn btn-danger me-1">{{__('messages.delete')}}</a>

                        <a href="" offer_id="{{$offer->id}}" class="delete_btn btn btn-danger me-1">حذف أجاكس</a>
                        <a href="{{route('ajax.offers.edit',$offer->id)}}" offer_id="{{$offer->id}}" class="btn btn-success me-1">تعديل أجاكس</a>
                        


                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- End Table -->
</div>
@stop



@section('scripts')
<script>
$(document).on('click', '.delete_btn', function(event) {
    event.preventDefault();
    var offer_id = $(this).attr('offer_id');
    $.ajax({
        type: 'post',
        url: "{{route('ajax.offers.delete')}}",
        data: {
            '_token': "{{csrf_token()}}",
            'id': offer_id,

        },
        success: function(response) {
            if (response.status == true) {
                alert(response.msg);
            }

            $('.offerRow' + response.id).remove();

        },
        error: function(response)

        {

        }
    });
});
</script>
@stop