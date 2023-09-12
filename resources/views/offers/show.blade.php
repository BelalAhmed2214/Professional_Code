@extends('offers.layout')
@section('content')
<div class="card" style="margin:20px;">
    <div class="card-header">offers Page</div>
    <div class="card-body">
        <div class="card-body">
            <div class="table-responsive">
                <div class="table"></div>
            <h5 class="card-title">OfferNameEnglish : {{$offers->name_en }}</h5>
            <h5 class="card-title">OfferNameArabic : {{ $offers->name_ar }}</h5>
            <h5 class="card-title">OfferPrice : {{ $offers->price }}</h5>
            <div class="card-title">
            <h5 class="card-title">OfferPhoto :</h5>
            <img style="width: 200px; height: 200px;" src="{{asset('images/offers/'.$offers->photo)}}">
            </div>
        </div>
        </hr>
    </div>
</div>
@stop
