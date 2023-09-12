@extends('layouts.app')
@section('content')
<div class="container h-100">

    <div class="row h-100 justify-content-center align-items-center">
        <div class="col-10 col-md-8 col-lg-6">
            <!-- Form -->
            <form class="form-example" id="offer_form_update" action="" method="post" enctype="multipart/form-data">
                @csrf
                <!-- Input fields -->
                <div class="form-group">
                    <label>{{__('messages.offer photo')}}</label>
                    <input type="file" name="photo" class="form-control username">
                    @error('photo')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>{{__('messages.offer name english')}}</label>
                    <input type="text" name="name_en" value="{{$offer->name_en}}" class="form-control username"
                        placeholder="{{__('messages.enter offer name english')}}">
                    <input type="text" style="display:none;" name="offer_id" value="{{$offer->id}}" class="form-control username">

                    @error('name_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label>{{__('messages.offer name arabic')}}</label>
                    <input type="text" name="name_ar" value="{{$offer->name_ar}}" class="form-control username"
                        placeholder="{{__('messages.enter offer name arabic')}}">
                    @error('name_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <br>
                <div class="form-group">
                    <label>{{__('messages.offer price')}}</label>
                    <input type="text" name="price" value="{{$offer->price}}" class="form-control password"
                        placeholder="{{__('messages.enter offer price')}}">
                    @error('price')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <button id="update_offer"
                    class="btn btn-primary btn-customized mt-4">تعديل العرض</button>
            </form>
            <!-- Form end -->
        </div>
    </div>
</div>

@stop


@section('scripts')
<script>
$(document).on('click', '#update_offer', function(event) {
    event.preventDefault();

    var formData = new FormData($('#offer_form_update')[0]);

    $.ajax({
        enctype: "multipart/form-data",
        type: 'post',
        url: "{{route('ajax.offers.update')}}",
        data: formData,
        processData: false,
        contentType: false,
        cache: false,
        success: function(response) {
            if (response.status == true)
                alert(response.msg);
        },
        error: function(response) {

        }
    });
});
</script>
@stop