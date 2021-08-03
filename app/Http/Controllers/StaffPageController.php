<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Models\PersonalInformation;
use App\Models\Document;
use App\Models\DocumentStatus;
use App\Models\GuarrantorForm;
use App\Models\StaffTable;
use App\Models\ClearanceStatus;

class StaffPageController extends Controller
{
    public function hodIndex()
    {
        $user_college = DB::table('staff_tables')->where(
            'fID', Auth::user()->fID
        )->first();

        $user_dept = DB::table('staff_tables')->where(
            'fID', Auth::user()->fID
        )->first();

        $documents = DB::table('documents')->where(
            'fID', Auth::user()->fID
        )->get();

        $details = DB::table('personal_information')->where(
            'dept', $user_dept->dept
        )->where(
            'college', $user_college->college
        )->get();

        // return $details;

        return view('hod.home', [
            'details' => $details
        ]);
    }

    public function clearanceStatus(Request $request)
    {
        // if(DB::table('clearance_statuses')->where('fID', $request->input('fID'))->exists())
        // {

        // }
        // else{

        if($request['clearance_status'] == 'NOT APPROVED')
        {

            DB::table('clearance_statuses')->where(
                'fID', $request['fID']
            )->update(
                [
                    'preliminary_form' => $request['clearance_status'],
                    'hod_recommendation' => $request['recommendation']
                ]
            );

            return redirect()->route('hod.home')->withStatus(__('Your Respond And Recommended Changes Have Been Noted '.$request['first_name']. ' Will Make The Neccessary Changes And Get Back to You'));
        } elseif ($request['clearance_status'] == 'CLEARED') {
            
            DB::table('clearance_statuses')->where(
                'fID', $request['fID']
            )->update(
                [
                    'preliminary_form' => $request['clearance_status']
                ]
            );

            return redirect()->route('hod.home')->withStatus(__('Your Respond Have Been Noted ' . $request['first_name'] . ' Will Notified'));
        }
           

            
            
        // }
    }

}
