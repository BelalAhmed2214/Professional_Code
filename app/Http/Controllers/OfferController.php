<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class OfferController extends Controller
{
    use OfferTrait;
    public function create()
    {
        return view('AjaxOffers.create');
    }
    public function store(OfferRequest $request)
    {
        //store photo to file
        $file_name = $this->saveImage($request->photo, 'images/offers');
        //store to database
        $offer = Offer::create([
            'photo' => $file_name,
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'price' => $request->price,
        ]);
        if ($offer) {
            return response()->json([
                'status' => true,
                'msg' => 'تم الحفظ بنجاح',
            ]);
        } 
        else 
        {
            return response()->json([
                "status" => false,
                "msg" => "فشل الحفظ حاول مرة أخرى",
            ]);
        }
    }
    public function all()
    {
        $offers = Offer::select('id', 'name_' . LaravelLocalization::getCurrentLocale() . ' as name', 'price', 'photo')->get();
        return view('AjaxOffers.all', compact('offers'));
    }
    public function delete(Request $request)
    {
        $offer = Offer::find($request->id);
        if (!$offer) {
            return response()->json([
                "status" => false,
                "msg" => "فشل الحذف حاول مرة أخرى",
            ]);
        } else {
            $offer->delete();
            return response()->json([
                "status" => true,
                "msg" => "تم الحذف بنجاح",
                'id' => $request->id,
            ]);
        }

    }
    public function edit(Request $request)
    {
        $offer = Offer::find($request->offer_id);
        if (!$offer) {
            return response()->json([
                "status" => false,
                "msg" => "العرض غير موجود",
            ]);
        }
        $offer = Offer::select('id', 'name_en', 'name_ar', 'price')->find($request->offer_id);
        return view('AjaxOffers.edit', compact('offer'));
    }

    public function update(Request $request)
    {

        $offer = Offer::find($request->offer_id);
        if (!$offer) {
            return response()->json([
                "status" => false,
                "msg" => "العرض غير موجود",
            ]);
        }
        else
        {
            $offer->update($request->all());
            return response()->json([
                "status" => true,
                "msg" => "تم التحديث بنجاح",
        ]);
        }

    }
}
