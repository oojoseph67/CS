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
    public function index()
    {
        if(Auth::user()->role == 'hod')
        {
            $user_college = DB::table('staff_tables')->where(
                'fID',
                Auth::user()->fID
            )->first();

            $user_dept = DB::table('staff_tables')->where(
                'fID',
                Auth::user()->fID
            )->first();

            $documents = DB::table('documents')->where(
                'fID',
                Auth::user()->fID
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

        }elseif (Auth::user()->role == 'pgo')
        {
            $details = DB::table('personal_information')->get();

            return view('pgo.home', [
                'details' => $details
            ]);
        }
      
    }

    public function clearanceStatus(Request $request)
    {
        // if(DB::table('clearance_statuses')->where('fID', $request->input('fID'))->exists())
        // {

        // }
        // else{

        if($request['clearance_type'] == 'preliminary_form')
        {
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
        }
        // elseif($request['clearance_type'] == 'document') {

        //     if($request['clearance_status'] == 'NOT APPROVED')
        //     {
        //         DB::table('clearance_statuses')->where(
        //             'fID', $request['fID']
        //         )->update(
        //             [
        //                 'document' => 'PENDING UPDATE',
        //                 'pg_officer_recommendation' => $request['recommendation']
        //             ]
        //         );

        //         // DB::table('document_statuses')->where(
        //         //     'fID', $request['fID']
        //         // )->update(
        //         //     [
        //         //         'passport' => $request['passport'],
        //         //         'ol_certificate' => $request['ol_certificate'],
        //         //         'ol_card' => $request['ol_card'],
        //         //         'ufd_hnd_certificate' => $request['ufd_hnd_certificate'],
        //         //         'rhd_diploma_certificate' => $request['rhd_diploma_certificate'],
        //         //         'nysc_exemption_certificate' => $request['nysc_exemption_certificate'],
        //         //         'clearnce_certificate_fupre' => $request['clearnce_certificate_fupre'],
        //         //         'birth_certificate' => $request['birth_certificate'],
        //         //         'state_of_origin_certificate' => $request['state_of_origin_certificate'],
        //         //         'marriage_certificate' => $request['marriage_certificate'],
        //         //         'admission_letter' => $request['admission_letter'],
        //         //         'application_form' => $request['application_form'],
        //         //         'transcript' => $request['transcript']
        //         //     ]
        //         // );

        //         return redirect()->route('pg-officer.home')->withStatus(__('Your Respond And Recommended Changes Have Been Noted ' . $request['first_name'] . ' Will Make The Necessary Changes And Get Back to You'));
        //     }
        //     elseif($request['clearance_status'] == 'CLEARED')
        //     {
        //         DB::table('clearance_statuses')->where(
        //             'fID', $request['fID']
        //         )->update(
        //             [
        //                 'document' => $request['clearance_status']
        //             ]
        //         );

        //         return redirect()->route('hod.home')->withStatus(__('Your Respond Have Been Noted ' . $request['first_name'] . ' Will Notified'));
        //     }
        // }
        // }
    }

    public function documentClearance(Request $request)
    {
        if ($request['clearance_status'] == 'NOT APPROVED') {
            
            DB::table('clearance_statuses')->where(
                'fID',
                $request['fID']
            )->update(
                [
                    'document' => 'PENDING UPDATE',
                    'pg_officer_recommendation' => $request['recommendation']
                ]
            );

            DB::table('document_statuses')->where(
                'fID', $request['fID']
            )->update(
                [
                    'passport' => $request['passport'],
                    'ol_certificate' => $request['ol_certificate'],
                    'ol_card' => $request['ol_card'],
                    'ufd_hnd_certificate' => $request['ufd_hnd_certificate'],
                    'rhd_diploma_certificate' => $request['rhd_diploma_certificate'],
                    'nysc_exemption_certificate' => $request['nysc_exemption_certificate'],
                    'clearnce_certificate_fupre' => $request['clearnce_certificate_fupre'],
                    'birth_certificate' => $request['birth_certificate'],
                    'state_of_origin_certificate' => $request['state_of_origin_certificate'],
                    'marriage_certificate' => $request['marriage_certificate'],
                    'admission_letter' => $request['admission_letter'],
                    'application_form' => $request['application_form'],
                    'transcript' => $request['transcript']
                ]
            );

            return redirect()->route('pg-officer.home')->withStatus(__('Your Respond And Recommended Changes Have Been Noted ' . $request['first_name'] . ' Will Make The Necessary Changes And Get Back to You'));
        } elseif ($request['clearance_status'] == 'CLEARED') {

            DB::table('clearance_statuses')->where(
                'fID',
                $request['fID']
            )->update(
                [
                    'document' => $request['clearance_status']
                ]
            );

            if ($request['passport'] == 'CLEARED') {
                DB::table('document_statuses')->where(
                    'fID',
                    Auth::user()->fID
                )->update(
                    [
                        'passport' => 'CLEARED',
                    ]
                );
            }

            if ($request['ol_certificate'] == 'CLEARED') {
                DB::table('document_statuses')->where(
                    'fID',
                    Auth::user()->fID
                )->update(
                    [
                        'ol_certificate' => 'CLEARED',
                    ]
                );
            }

            if ($request['ufd_hnd_certificate'] == 'CLEARED') {
                DB::table('document_statuses')->where(
                    'fID',
                    Auth::user()->fID
                )->update(
                    [
                        'ufd_hnd_certificate' => 'CLEARED',
                    ]
                );
            }

            if ($request['rhd_diploma_certificate'] == 'CLEARED') {
                DB::table('document_statuses')->where(
                    'fID',
                    Auth::user()->fID
                )->update(
                    [
                        'rhd_diploma_certificate' => 'CLEARED',
                    ]
                );
            }

            if ($request['nysc_exemption_certificate'] == 'CLEARED') {

                DB::table('document_statuses')->where(
                    'fID',
                    Auth::user()->fID
                )->update(
                    [
                        'nysc_exemption_certificate' => 'CLEARED',
                    ]
                );
            }

            if ($request['clearnce_certificate_fupre'] == 'CLEARED') {

                DB::table('document_statuses')->where(
                    'fID',
                    Auth::user()->fID
                )->update(
                    [
                        'clearnce_certificate_fupre' => 'CLEARED',
                    ]
                );
            }

            if ($request['birth_certificate'] == 'CLEARED') {
                DB::table('document_statuses')->where(
                    'fID',
                    Auth::user()->fID
                )->update(
                    [
                        'birth_certificate' => 'CLEARED',
                    ]
                );
            }

            if ($request['state_of_origin_certificate'] == 'CLEARED') {
                DB::table('document_statuses')->where(
                    'fID',
                    Auth::user()->fID
                )->update(
                    [
                        'state_of_origin_certificate' => 'CLEARED',
                    ]
                );
            }

            if ($request['marriage_certificate'] == 'CLEARED') {
                DB::table('document_statuses')->where(
                    'fID',
                    Auth::user()->fID
                )->update(
                    [
                        'marriage_certificate' => 'CLEARED',
                    ]
                );
            }

            if ($request['admission_letter'] == 'CLEARED') {
                DB::table('document_statuses')->where(
                    'fID',
                    Auth::user()->fID
                )->update(
                    [
                        'admission_letter' => 'CLEARED',
                    ]
                );
            }

            if ($request['application_form'] == 'CLEARED') {

                DB::table('document_statuses')->where(
                    'fID',
                    Auth::user()->fID
                )->update(
                    [
                        'application_form' => 'CLEARED'
                    ]
                );
            }

            if ($request['transcript'] == 'CLEARED') {

                DB::table('document_statuses')->where(
                    'fID',
                    Auth::user()->fID
                )->update(
                    [
                        'transcript' => 'CLEARED'
                    ]
                );
            }

            if ($request['ol_card'] == 'CLEARED') {

                DB::table('document_statuses')->where(
                    'fID',
                    Auth::user()->fID
                )->update(
                    [
                        'ol_card' => 'CLEARED',
                    ]
                );
            }

            return redirect()->route('hod.home')->withStatus(__('Your Respond Have Been Noted ' . $request['first_name'] . ' Will Notified'));
        }
    }

}
