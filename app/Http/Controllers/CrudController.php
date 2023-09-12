<?php
namespace App\Http\Controllers;

use App\Events\VideoViewer;
use App\Http\Requests\OfferRequest;
use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\Video;
use App\Traits\OfferTrait;
use Illuminate\Support\Facades\Validator;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CrudController extends Controller
{
    use OfferTrait;
    public function create()
    {
        return view('offers.create');
    }
    public function store(OfferRequest $request)
    {   
        //store photo to file
        $file_name = $this->saveImage($request->photo, 'images/offers');
        //store to database 
        Offer::create([
            'photo'=>$file_name,
            'name_en' => $request->name_en,
            'name_ar' => $request->name_ar,
            'price' => $request->price,
        ]);
        return redirect()->route('offers.all')->with(['status'=>'تم إضافة العرض بنجاح']);
    }      


    public function show($offer_id)
    {
        $offers=Offer::find($offer_id);
        return view('offers.show',compact('offers'));
    }
    public function index()
    {
        //using scope in Model:Offer
        $offers=Offer::SelectOffers()->paginate(PAGINATION_COUNT);
        return view('offers.index',compact('offers'));
    }



    public function edit($offer_id)
    {
        $offer=Offer::find($offer_id);
        if(!$offer)
        {
            return redirect()->back();
        }
        $offer=Offer::select('id','name_en','name_ar','price')->find($offer_id);
        return view('offers.edit',compact('offer'));
    }




    public function update(OfferRequest $request,$offer_id)
    { 

        $offer=Offer::find($offer_id);
        if(!$offer)
        {
            return redirect()->back();
        }
        $offer->update($request->all());
        return redirect()->route('offers.all')->with(['status'=>'تم تعديل العرض بنجاح']);
    }

  
    public function delete($offer_id)
    {
        $offer=Offer::find($offer_id);
        if(!$offer)
        {
            return redirect()
                    ->back()
                    ->with(['error'=>__('messages.offer not exist')]);
        }
        else
        {
            $offer->delete();
            return redirect()
                    ->route('offers.all',$offer_id)
                    ->with(['error'=>__('messages.offer deleted successfully')]);
        }
    }

    // Event And Listener
    public function getVideo()
    {
        $video=Video::first();
        event(new VideoViewer($video));
        return view('video',compact('video'));
    }
}

?>