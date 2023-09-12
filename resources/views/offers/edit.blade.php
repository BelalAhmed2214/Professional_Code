@extends('offers.layout')
@section('content')
   
    <div class="container h-100">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-10 col-md-8 col-lg-6">
                @if(Session::has('status'))
                <div class="alert alert-success" role="alert">
                    {{Session::get('status')}}
                </div>
                @endif
                <!-- Form -->
                <form class="form-example" action="{{route('offers.update',$offer->id)}}" method="post" enctype="multipart/form-data">
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

                    <button type="submit"
                        class="btn btn-primary btn-customized mt-4">{{__('messages.save offer')}}</button>
                </form>
                <!-- Form end -->
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
@endsection