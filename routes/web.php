<?php
use App\Http\Controllers\CrudController;
use App\Http\Controllers\OfferController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\RelationController;



define('PAGINATION_COUNT',5);
Route::get('/',function(){
    return view('welcome');
});
Route::get('/dashboard',function(){
    return 'Not Allowed';
})->name('check.age');

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



############### Begin CrudOffers Routes ###############
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],function(){

Route::group(['prefix'=>'offers',"as"=>"offers."],function(){
        Route::get('create',[CrudController::class,'create'])->name('create');
        Route::post('store',[CrudController::class,'store'])->name('store');
        Route::get('all',[CrudController::class,'index'])->name('all');
        Route::get('offers-in-active',[CrudController::class,'offersInactive']);

        Route::get('edit/{id}',[CrudController::class,'edit'])->name('edit');        
        Route::post('update/{id}',[CrudController::class,'update'])->name('update');
        Route::get('delete/{id}',[CrudController::class,'delete'])->name('delete');
        Route::get('show/{id}',[CrudController::class,'show'])->name('show');
         
});
        Route::get('youtube',[CrudController::class,'getVideo'])->middleware('auth')->name('youtube');
});
############### End CrudOffers Routes ###############

############### Begin Ajax Routes ###############
Route::group(['prefix'=>'AjaxOffers',"as"=>"ajax.offers."],function(){
    Route::get('create',[OfferController::class,'create'])->name('create');
    Route::post('store',[OfferController::class,'store'])->name('store');
    Route::get('all',[OfferController::class,'all'])->name('all');
    Route::post('delete',[OfferController::class,'delete'])->name('delete');
    Route::get('edit/{offer_id}',[OfferController::class,'edit'])->name('edit');        
    Route::post('update',[OfferController::class,'update'])->name('update');

});
############### End Ajax Routes ###############
############### Begin Authenticate&Guards Routes ###############
Route::group(['middleware'=>'CheckAge'],function(){
    Route::get('adults',[CustomAuthController::class,'adults'])->name('adults');
});

Route::get('site',[CustomAuthController::class,'site'])->middleware('auth')->name('site');
Route::get('admin',[CustomAuthController::class,'admin'])->middleware('auth:admin')->name('admin');
Route::get('admin/login',[CustomAuthController::class,'adminLogin'])->name('admin.login');
Route::post('admin/login',[CustomAuthController::class,'checkAdminLogin'])->name('save.admin.login');


############### End Authenticate&Guards Routes ###############

###############Begin Relations#########################


################ Begin One To One Relations ###################################
Route::get('has-one',[RelationController::class,'has_one']);
Route::get('has-one-rev',[RelationController::class,'has_one_rev']);
Route::get('where-has-phone',[RelationController::class,'where_has_phone']);
Route::get('where-has-not-phone',[RelationController::class,'where_has_not_phone']);
Route::get('phone-condition',[RelationController::class,'phone_condition']);
################## End One To One Relations ######################################

############### Begin One To Many Relations ######################################
Route::get('hospital-has-many',[RelationController::class,'getHospitalDoctors']);
Route::get('hospitals',[RelationController::class,'hospitals'])->name('all.hospitals');
Route::get('hospitals/{hospital_id}',[RelationController::class,'deleteHospitals'])->name('hospital.delete');
Route::get('doctors/services/{doctor_id}',[RelationController::class,'showServices'])->name('doctor.services');
Route::get('doctors/{hospital_id}',[RelationController::class,'doctors'])->name('hospital.doctors');
Route::get('hospital-has-doctors-males',[RelationController::class,'hospital_has_doctors_males']);
Route::get('hospital-hasnot-doctors',[RelationController::class,'hospital_hasnot_doctors']);
Route::get('doctor/service',[RelationController::class,'getDoctorServices']);
Route::get('service/doctor',[RelationController::class,'getServiceDoctors']);
Route::get('choose-doctor-services',[RelationController::class,'chooseDoctorandServices'])->name('choose.Doctor.Services');
Route::post('save-doctor-services',[RelationController::class,'saveDoctorandServices'])->name('save.Doctor.Services');
############### End One To Many Relations #######################################

############### Begin hasOneThrough #################################################
Route::get('patient-doctor',[RelationController::class,'patientDoctor'])->name('patient.doctor');
Route::get('country-doctor',[RelationController::class,'countryDoctor'])->name('country.doctor');
Route::get('country-hospital',[RelationController::class,'countryHospital'])->name('country.hospital');

############### End hasOneThrough ###################################################


############### End Relations ###################################################

###################### Begin Accessors ###################################################
Route::get('accessors',[RelationController::class,'getDoctors']);  //get data From Database
###################### End Accessors #######################################################



Route::get('collections',[RelationController::class,'index']);
Route::get('each',[RelationController::class,'complex']);
Route::get('filter',[RelationController::class,'filter']);
