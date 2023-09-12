<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Patient;
use App\Models\User;
use App\Models\Phone;
use App\Models\Service;
use Illuminate\Http\Request;

use function GuzzleHttp\Promise\each;

class RelationController extends Controller
{
    public function has_one()
    {
        $user=User::with('phone')->find(9);
        return $user;
    }
    public function has_one_rev()
    {
        $phone=Phone::with(['user'=>function($q){
            $q -> select('id','name','age');
        }])->find(1);

        return $phone;
        
    }
    public function where_has_phone()
    {
        $user=User::whereHas('phone')->get();
        return $user;
    }
    public function where_has_not_phone()
    {
        $user=User::whereDoesntHave('phone')->get();
        return $user;
    }
    public function phone_condition()
    {
        $user=User::whereHas('phone',function($q){
            $q->where('code','+02');
        })->get();
        return $user;    
    }
    public function getHospitalDoctors()
    {
        $hospital=Hospital::with('doctors')->find(2);   
    }
    public function hospitals()
    {
        $hospitals=Hospital::select('id','name','address')->get();
        return view('doctors.hospitals',compact('hospitals'));
    }
    public function doctors($hospital_id)
    {
        $hospital=Hospital::find($hospital_id);
        $doctors=$hospital->doctors;
        return view('doctors.doctors',compact('doctors'));
    }
    public function hospital_has_doctors_males()
    {
       return $hospitals = Hospital::with('doctors')->whereHas('doctors',function($q){
            $q->where('gender',2);
        })->get();
        
    }
    public function hospital_hasnot_doctors()
    {
        return $hospitals = Hospital::whereDoesntHave('doctors')->get();
    }
    public function deleteHospitals($hospital_id)
    {
        $hospital = Hospital::find($hospital_id);
        if(!$hospital)
        {
            return abort('404');
        }
        else
        {
            $hospital->doctors()->delete();
            $hospital->delete();
            return redirect()->route('all.hospitals');
        }
    }
    public function getDoctorServices()
    {
        $doctor=Doctor::with('services')->find(2);
        // $doctor->services->makeHidden(['doctor_id','service_id']);
        return $doctor->services;
    }
    public function getServiceDoctors()
    {
        $doctors=Service::with(['doctors'=>function($q){
            $q->select('doctors.id','name','title');
        }])->find(4);
        return $doctors;
    }
    public function showServices($doctor_id)
    {
        $doctors=Doctor::find($doctor_id);
        $services=$doctors->services;
        $doctorName=$doctors->name;
        return view('doctors.services',compact('services','doctorName'));
    }
    public function chooseDoctorandServices()
    {
        $doctors=Doctor::select('id','name')->get();
        $allServices=Service::select('id','name')->get();
        return view('doctors.form',compact('doctors','allServices'));
        
    }
    public function saveDoctorandServices(Request $request)
    {
        $doctor=Doctor::find($request->doctor_id);
        if (!$doctor)
        {
            return abort('404');
        }
        else
        {
            $doctor->services()->syncWithoutDetaching($request-> servicesIds);
        }
        return redirect()->route('doctor.services',$request->doctor_id);
    }
    public function patientDoctor()
    {
        $patient=Patient::with('doctors')->find(1);
        return $patient->doctors;
    }
    public function countryDoctor()
    {
        $country=Country::find(1);
        return $country->doctors;
    }
    public function countryHospital()
    {
        $country=Country::find(2);
        return $country->hospitals;
    }
    public function getDoctors()
    {
        $doctors=Doctor::select('id','name','gender')->where('gender',2)->get();
        return $doctors;    
    }
    public function index()
    {
        //combine Key of array with it's Value
        $data=collect(['name','age']);
        $res=$data->combine(['ahmed',"28"]);
        return $res;        
    }
    public function complex()
    {
        $doctors=Doctor::get();   
        //each Method
        $doctors -> each(function($doctor){
            if($doctor->medical_id==0)
            {
                $doctor->medical_id="You don't have medicalProfile";
            }
        });
        return $doctors;
    }
    public function filter()
    {
        $doctors=Doctor::get();
        $doctors=collect($doctors);
        $resFilter=$doctors->filter(function($value,$key){
            return $value['medical_id']!=0;
        });
        //we want to hide key of collection so we will convert it into array
        return array_values($resFilter->all());
    }

    
}
