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
use App\Models\ClearanceStatus;


class StudentPageController extends Controller
{
    public function index()
    {
        $details = DB::table('personal_information')->where(
            'fID', Auth::user()->fID
        )->get();

        $documents = DB::table('documents')->where(
            'fID', Auth::user()->fID
        )->get();

        $form_statuses = DB::table('clearance_statuses')->where(
            'fID', Auth::user()->fID
        )->get();

        return view('students.home', [
            'details' => $details,
            'documents' => $documents,
            'form_statuses' => $form_statuses
        ]);
    }

    public function personalForm(Request $request)
    {
        $store_user = PersonalInformation::create([
            'fID' => $request['fID'],
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'gsm' => ('+').$request['gsm'],
            'dob' => $request['dob'],
            'place_of_birth' => $request['place_of_birth'],
            'disability' => $request['disability'],
            'name_of_guarrantor' => $request['name_of_guarrantor'],
            'address_of_guarrantor' => $request['address_of_guarrantor'],
            'gsm_of_guarrantor' => $request['gsm_of_guarrantor'],
            'resident_address' => $request['resident_address'],
            'private_address' => $request['private_address'],
            'permmanent_address' => $request['permmanent_address'],
            'sponsor_name' => $request['sponsor_name'],
            'sponsor_address' => $request['sponsor_address'],
            'sponsor_gsm' => ('+').$request['sponsor_gsm'],
            'name_of_next_of_kin' => $request['name_of_next_of_kin'],
            'address_of_next_of_kin' => $request['address_of_next_of_kin'],
            'gsm_of_next_of_kin' => ('+').$request['gsm_of_next_of_kin'],
            'email_of_next_of_kin' => $request['email_of_next_of_kin'],
            'sex' => $request['sex'],
            'martial_status' => $request['martial_status'],
            'title' => $request['title'],
            'nationality' => $request['nationality'],
            'religion' => $request['religion'],
            'state_of_origin' => $request['state_of_origin'],
            'language' => $request['language'],
            'level_of_entry' => $request['level_of_entry'],
            'mode_of_entry' => $request['mode_of_entry'],
            'year_of_entry' => $request['year_of_entry'],
            'mode_of_study' => $request['mode_of_study'],
            'college' => $request['college'],
            // 'dept' => $request['dept'],
            'mat_no' => $request['mat_no'],
            'programme_of_study' => $request['programme_of_study'],
            // 'expected_graduation_year' => $request['year_of_graduation']
        ]);

        $store_user->save();

        DB::table('users')->where(
            'fID', $request['fID']
        )->update([
            'personal_form' => 'FILLLED'
        ]);

        $clearance = ClearanceStatus::create([
            'fID' => $request['fID'],
            'personal_form'=> 'PENDING REVIEW'
        ]);

        $clearance->save();

        return redirect()->route('student.home')->withStatus(__('Hey '. $request['last_name']. ' Congratulations on filling your personal form. Now Please Submit Your Document '. $request['role']));
    }

    public function document(Request $request)
    {
        $request->validate([
            'passport' => ['required', 'mimes:jpeg,png,gif,jpg', 'max:10024'],
            'ol_certificate' => ['required', 'mimes:pdf', 'max:10024'],
            'ufd_hnd_certificate' => ['required', 'mimes:pdf', 'max:10024'],
            'rhd_diploma_certificate' => ['required', 'mimes:pdf', 'max:10024'],
            'nysc_exemption_certificate' => ['required', 'mimes:pdf', 'max:10024'],
            'clearnce_certificate_fupre' => ['required', 'mimes:pdf', 'max:10024'],
            'birth_certificate' => ['required', 'mimes:pdf', 'max:10024'],
            'state_of_origin_certificate' => ['required', 'mimes:pdf', 'max:10024'],
            'marriage_certificate' => ['required', 'mimes:pdf', 'max:10024'],
            'admission_letter' => ['required', 'mimes:pdf', 'max:10024'],
            'application_form' => ['required', 'mimes:pdf', 'max:10024'],
            'transcript' => ['required', 'mimes:pdf', 'max:10024']
        ]);

        // $name = $request->file('passport')->getClientOriginalName();
        // $extension = $request->file('passport')->extension();

        $passport = $request->file('passport');
        $passport_name = rand().".".$request->file('passport')->extension();
        $passport->move(public_path("documents/passport"), $passport_name);

        $ol_certificate = $request->file('ol_certificate');
        $ol_certificate_name = rand().".".$request->file('ol_certificate')->extension();
        $ol_certificate->move(public_path("documents/file"), $ol_certificate_name);

        $ufdhnd_certificate = $request->file('ufd_hnd_certificate');
        $ufdhnd_certificate_name = rand().".".$request->file('ufd_hnd_certificate')->extension();
        $ufdhnd_certificate->move(public_path("documents/file"), $ufdhnd_certificate_name);

        $rhddiploma_certificate = $request->file('rhd_diploma_certificate');
        $rhddiploma_certificate_name = rand().".".$request->file('rhd_diploma_certificate')->extension();
        $rhddiploma_certificate->move(public_path("documents/file"), $rhddiploma_certificate_name);

        $nyscexemption_certificate = $request->file('nysc_exemption_certificate');
        $nyscexemption_certificate_name = rand().".".$request->file('nysc_exemption_certificate')->extension();
        $nyscexemption_certificate->move(public_path("documents/file"), $nyscexemption_certificate_name);

        $clearnce_certificate_fupre = $request->file('clearnce_certificate_fupre');
        $clearnce_certificate_fupre_name = rand().".".$request->file('clearnce_certificate_fupre')->extension();
        $clearnce_certificate_fupre->move(public_path("documents/file"), $clearnce_certificate_fupre_name);

        $birth_certificate = $request->file('birth_certificate');
        $birth_certificate_name = rand().".".$request->file('birth_certificate')->extension();
        $birth_certificate->move(public_path("documents/file"), $birth_certificate_name);
        
        $state_of_origin_certificate = $request->file('state_of_origin_certificate');
        $state_of_origin_certificate_name = rand().".".$request->file('state_of_origin_certificate')->extension();
        $state_of_origin_certificate->move(public_path("documents/file"), $state_of_origin_certificate_name);


        $marriage_certificate = $request->file('marriage_certificate');
        $marriage_certificate_name = rand().".".$request->file('marriage_certificate')->extension();
        $marriage_certificate->move(public_path("documents/file"), $marriage_certificate_name);


        $admission_letter = $request->file('admission_letter');
        $admission_letter_name = rand().".".$request->file('admission_letter')->extension();
        $admission_letter->move(public_path("documents/file"), $admission_letter_name);

        $application_form = $request->file('application_form');
        $application_form_name = rand().".".$request->file('application_form')->extension();
        $application_form->move(public_path("documents/file"), $application_form_name);

        $transcript = $request->file('transcript');
        $transcript_name = rand().".".$request->file('transcript')->extension();
        $transcript->move(public_path("documents/file"), $transcript_name);

        // $path = $request->file('passort')->storeAs('photos');
        // $path = Storage::putFile('avatars', $request->file('passort'));
        // dd($passort_path);

        $store_documment = Document::create([
            'fID' => $request['fID'],
            'passport' => $passport_name,
            'ol_certificate' => $ol_certificate_name,
            'ol_card' => $request['ol_card'],
            'ufd_hnd_certificate' => $ufdhnd_certificate_name,
            'rhd_diploma_certificate' => $rhddiploma_certificate_name,
            'nysc_exemption_certificate' => $nyscexemption_certificate_name,
            'clearnce_certificate_fupre' => $clearnce_certificate_fupre_name,
            'birth_certificate' => $birth_certificate_name,
            'state_of_origin_certificate' => $state_of_origin_certificate_name,
            'marriage_certificate' => $marriage_certificate_name,
            'admission_letter' => $admission_letter_name,
            'application_form' => $application_form_name,
            'transcript' => $transcript_name
        ]);

        $store_documment->save();

        $store_documment_status = DocumentStatus::create([
            'fID' => $request['fID'],
            'passport' => 'UPLOADED',
            'ol_certificate' => 'UPLOADED',
            'ol_card' => 'UPLOADED',
            'ufd_hnd_certificate' => 'UPLOADED',
            'rhd_diploma_certificate' => 'UPLOADED',
            'nysc_exemption_certificate' => 'UPLOADED',
            'clearnce_certificate_fupre' => 'UPLOADED',
            'birth_certificate' => 'UPLOADED',
            'state_of_origin_certificate' => 'UPLOADED',
            'marriage_certificate' => 'UPLOADED',
            'admission_letter' => 'UPLOADED',
            'application_form' => 'UPLOADED',
            'transcript' => 'UPLOADED'
        ]);

        $store_documment_status->save();  

        DB::table('clearance_statuses')->where(
            'fID', Auth::user()->fID
        )->update(
            [
                'document' => 'PENDING REVIEW'
            ]
        );

        DB::table('users')->where(
            'fID', $request['fID']
        )->update([
            'documents' => 'SUBMITTED'
        ]);

        return redirect()->route('student.home')->withStatus(__('Hey '. $request['last_name']. ' Congratulations on Submitting Your Document. How Proceed In Filling The Prelimiary Form'));
    }

    public function preliminaryForm(Request $request)
    {
        DB::table('personal_information')->where(
            'fID', $request['fID']
        )->update(
            [
                'dept' => $request['dept'],
                'expected_graduation_year' => $request['year_of_graduation'],
                'lga' => $request['lga'],
                'parent_name' => $request['parent_name'],
                'parent_address' => $request['parent_address'],
                'employer_name' => $request['employer_name'],
                'employer_address' => $request['employer_address'],
                'employer_gsm' => ('+').$request['employer_gsm'],
                'landlord_name' => $request['landlord_name'],
                'landlord_address' => $request['landlord_address'],
                'landlord_gsm' => ('+').$request['landlord_gsm'],
                'health_challenges' => $request['health_challenges'],
            ]
        );

        DB::table('clearance_statuses')->where(
            'fID', Auth::user()->fID
        )->update(
            [
                'preliminary_form' => 'PENDING REVIEW'
            ]
        );

        DB::table('users')->where(
            'fID', $request['fID']
        )->update([
            'preliminary_form' => 'FILLLED'
        ]);

        return redirect()->route('student.home')->withStatus(__('Hey '. $request['last_name']. ' Congratulations on Filling The Preliminary Form'));
    }

    public function clearanceForm(Request $request)
    {
        DB::table('personal_information')->where(
            'fID', $request['fID']
        )->update(
            [
                'mat_no' => $request['mat_no'],
                'qualification_on_entry' => $request['qualification_on_entry'],
                'qualification_currently' => $request['qualification_currently'],
                'institution_attended' => $request['institution_attended'],
                'institution_attended_date' => $request['institution_attended_date'],
            ]
        );

        DB::table('clearance_statuses')->where(
            'fID', Auth::user()->fID
        )->update(
            [
                'clearance_form' => 'PENDING REVIEW'
            ]
        );

        DB::table('users')->where(
            'fID', $request['fID']
        )->update([
            'clearance_form' => 'FILLLED'
        ]);

        return redirect()->route('student.home')->withStatus(__('Hey '. $request['last_name']. ' Congratulations on Filling The Clearance Form'));
    }

    public function guarrantorForm(Request $request)
    {
        $store_guarrantor = GuarrantorForm::create([
            'fID' => $request['fID'],
            'name' => $request['name'],
            'gsm' => $request['gsm'],
            'email' => $request['email'],
            'title' => $request['title'],
            'position' => $request['position'],
            'name_of_institution' => $request['name_of_institution'],
            'address_of_institution' => $request['address_of_institution'],
            'time_with_applicant' => $request['time_with_applicant'],
            'capacity' => $request['capacity'],
            'academic_performance' => $request['academic_performance'],
            'academic_achievement' => $request['academic_achievement'],
            'research_potential' => $request['research_potential'],
            'originality' => $request['originality'],
            'judgment' => $request['judgment'],
            'motivation' => $request['motivation'],
            'ability_to_work_independently' => $request['ability_to_work_independently'],
            'oral_expression' => $request['oral_expression'],
            'written_expression' => $request['written_expression'],
            'potential' => $request['potential'],
            'reference_letter' => $request['reference_letter'],
            'recommendation' => $request['recommendation']
        ]);

        $store_guarrantor->save();

        DB::table('clearance_statuses')->where(
            'fID', Auth::user()->fID
        )->update(
            [
                'guarrantor_form' => 'PENDING REVIEW'
            ]
        );

        DB::table('users')->where(
            'fID', $request['fID']
        )->update([
            'guarrantor_form' => 'FILLLED'
        ]);

        return redirect()->route('student.home')->withStatus(__('Hey '. $request['last_name']. ' Congratulations on Filling The Guarrantor Form'));
    }

    public function updatePreliminaryForm(Request $request)
    {
        DB::table('personal_information')->where(
            'fID', Auth::user()->fID 
        )->update(
            [
                'gsm' => $request['gsm'],
                'dob' => $request['dob'],
                'sex' => $request['sex'],
                'martial_status' => $request['martial_status'],
                'place_of_birth' => $request['place_of_birth'],
                'state_of_origin' => $request['state_of_origin'],
                'nationality' => $request['nationality'],
                'lga' => $request['lga'],
                'religion' => $request['religion'],
                'health_challenges' => $request['health_challenges'],                
                'parent_name' => $request['parent_name'],
                'parent_address' => $request['parent_address'],
                'sponsor_name' => $request['sponsor_name'],
                'sponsor_address' => $request['sponsor_address'],
                'employer_name' => $request['employer_name'],
                'employer_address' => $request['employer_address'],
                'employer_gsm' => $request['employer_gsm'],
                'mat_no' => $request['mat_no'],
                'programme_of_study' => $request['programme_of_study'],
                'dept' => $request['dept'],
                'year_of_entry' => $request['year_of_entry'],
                'mode_of_study' => $request['mode_of_study'],
                'expected_graduation_year' => $request['year_of_graduation'],
                'resident_address' => $request['resident_address'],
                'landlord_name' => $request['landlord_name'],
                'landlord_address' => $request['landlord_address'],
                'landlord_gsm' => $request['landlord_gsm'],


                // 'disability' => $request['disability'],
                // 'name_of_guarrantor' => $request['name_of_guarrantor'],
                // 'address_of_guarrantor' => $request['address_of_guarrantor'],
                // 'gsm_of_guarrantor' => $request['gsm_of_guarrantor'],
                // 'private_address' => $request['private_address'],
                // 'permmanent_address' => $request['permmanent_address'],
                // 'sponsor_gsm' => ('+') . $request['sponsor_gsm'],
                // 'name_of_next_of_kin' => $request['name_of_next_of_kin'],
                // 'address_of_next_of_kin' => $request['address_of_next_of_kin'],
                // 'gsm_of_next_of_kin' => ('+') . $request['gsm_of_next_of_kin'],
                // 'email_of_next_of_kin' => $request['email_of_next_of_kin'],
                // 'title' => $request['title'],
                // 'language' => $request['language'],
                // 'level_of_entry' => $request['level_of_entry'],
                // 'mode_of_entry' => $request['mode_of_entry'],
            ]
            );

            DB::table('clearance_statuses')->where(
                'fID', Auth::user()->fID
            )->update(
                [
                    'preliminary_form' => 'UPDATED'
                ]
            );

            return back()->withStatus(__('Your Changes Have Been Made And Will Be Looked Into'));
    }

    public function documentUpdate(Request $request)
    {
        $request->validate([
            'passport' => ['mimes:jpeg,png,gif,jpg', 'max:10024'],
            'ol_certificate' => ['mimes:pdf', 'max:10024'],
            'ufd_hnd_certificate' => ['mimes:pdf', 'max:10024'],
            'rhd_diploma_certificate' => ['mimes:pdf', 'max:10024'],
            'nysc_exemption_certificate' => ['mimes:pdf', 'max:10024'],
            'clearnce_certificate_fupre' => ['mimes:pdf', 'max:10024'],
            'birth_certificate' => ['mimes:pdf', 'max:10024'],
            'state_of_origin_certificate' => ['mimes:pdf', 'max:10024'],
            'marriage_certificate' => ['mimes:pdf', 'max:10024'],
            'admission_letter' => ['mimes:pdf', 'max:10024'],
            'application_form' => ['mimes:pdf', 'max:10024'],
            'transcript' => ['mimes:pdf', 'max:10024']
        ]);

        // $name = $request->file('passport')->getClientOriginalName();
        // $extension = $request->file('passport')->extension();

        if($request->file('passport') != '')
        {
            $passport = $request->file('passport');
            $passport_name = rand() . "." . $request->file('passport')->extension();
            $passport->move(public_path("documents/passport"), $passport_name);


            DB::table('documents')->where(
                'fID',
                Auth::user()->fID
            )->update(
                [
                    'passport' => $passport_name,
                ]
            );

            DB::table('document_statuses')->where(
                'fID',
                Auth::user()->fID
            )->update(
                [
                    'passport' => 'UPDATED',
                ]
            );
        }

        if ($request->file('ol_certificate') != '') {
            $ol_certificate = $request->file('ol_certificate');
            $ol_certificate_name = rand() . "." . $request->file('ol_certificate')->extension();
            $ol_certificate->move(public_path("documents/file"), $ol_certificate_name);

            DB::table('documents')->where(
                'fID',
                Auth::user()->fID
            )->update(
                [
                    'ol_certificate' => $ol_certificate_name,
                ]
            );

            DB::table('document_statuses')->where(
                'fID',
                Auth::user()->fID
            )->update(
                [
                    'ol_certificate' => 'UPDATED',
                ]
            );
        }

        if ($request->file('ufd_hnd_certificate') != '') {
            $ufdhnd_certificate = $request->file('ufd_hnd_certificate');
            $ufdhnd_certificate_name = rand() . "." . $request->file('ufd_hnd_certificate')->extension();
            $ufdhnd_certificate->move(public_path("documents/file"), $ufdhnd_certificate_name);

            DB::table('documents')->where(
                'fID',
                Auth::user()->fID
            )->update(
                [  
                    'ufd_hnd_certificate' => $ufdhnd_certificate_name,
                ]
            );

            DB::table('document_statuses')->where(
                'fID',
                Auth::user()->fID
            )->update(
                [
                    'ufd_hnd_certificate' => 'UPDATED',
                ]
            );
        }

        if ($request->file('rhd_diploma_certificate') != '') {
            $rhddiploma_certificate = $request->file('rhd_diploma_certificate');
            $rhddiploma_certificate_name = rand() . "." . $request->file('rhd_diploma_certificate')->extension();
            $rhddiploma_certificate->move(public_path("documents/file"), $rhddiploma_certificate_name);

            DB::table('documents')->where(
                'fID',
                Auth::user()->fID
            )->update(
                [
                    'rhd_diploma_certificate' => $rhddiploma_certificate_name,
                ]
            );

            DB::table('document_statuses')->where(
                'fID',
                Auth::user()->fID
            )->update(
                [
                    'rhd_diploma_certificate' => 'UPDATED',
                ]
            );
        }

        if ($request->file('nysc_exemption_certificate') != '') {
            $nyscexemption_certificate = $request->file('nysc_exemption_certificate');
            $nyscexemption_certificate_name = rand() . "." . $request->file('nysc_exemption_certificate')->extension();
            $nyscexemption_certificate->move(public_path("documents/file"), $nyscexemption_certificate_name);

            DB::table('documents')->where(
                'fID',
                Auth::user()->fID
            )->update(
                [
                    'nysc_exemption_certificate' => $nyscexemption_certificate_name,
                ]
            );

            DB::table('document_statuses')->where(
                'fID',
                Auth::user()->fID
            )->update(
                [
                    'nysc_exemption_certificate' => 'UPDATED',
                ]
            );

        }

        if ($request->file('clearnce_certificate_fupre') != '') {
            $clearnce_certificate_fupre = $request->file('clearnce_certificate_fupre');
            $clearnce_certificate_fupre_name = rand() . "." . $request->file('clearnce_certificate_fupre')->extension();
            $clearnce_certificate_fupre->move(public_path("documents/file"), $clearnce_certificate_fupre_name);

            DB::table('documents')->where(
                'fID',
                Auth::user()->fID
            )->update(
                [
                    'clearnce_certificate_fupre' => $clearnce_certificate_fupre_name,
                ]
            );

            DB::table('document_statuses')->where(
                'fID',
                Auth::user()->fID
            )->update(
                [
                    'clearnce_certificate_fupre' => 'UPDATED',
                ]
            );
        }

        if ($request->file('birth_certificate') != '') {
            $birth_certificate = $request->file('birth_certificate');
            $birth_certificate_name = rand() . "." . $request->file('birth_certificate')->extension();
            $birth_certificate->move(public_path("documents/file"), $birth_certificate_name);

            DB::table('documents')->where(
                'fID',
                Auth::user()->fID
            )->update(
                [
                    'birth_certificate' => $birth_certificate_name,
                ]
            );

            DB::table('document_statuses')->where(
                'fID',
                Auth::user()->fID
            )->update(
                [
                    'birth_certificate' => 'UPDATED',
                ]
            );
        }

        if ($request->file('state_of_origin_certificate') != '') {
            $state_of_origin_certificate = $request->file('state_of_origin_certificate');
            $state_of_origin_certificate_name = rand() . "." . $request->file('state_of_origin_certificate')->extension();
            $state_of_origin_certificate->move(public_path("documents/file"), $state_of_origin_certificate_name);

            DB::table('documents')->where(
                'fID',
                Auth::user()->fID
            )->update(
                [
                    'state_of_origin_certificate' => $state_of_origin_certificate_name,
                ]
            );

            DB::table('document_statuses')->where(
                'fID',
                Auth::user()->fID
            )->update(
                [
                    'state_of_origin_certificate' => 'UPDATED',
                ]
            );
        }

        if ($request->file('marriage_certificate') != '') {
            $marriage_certificate = $request->file('marriage_certificate');
            $marriage_certificate_name = rand() . "." . $request->file('marriage_certificate')->extension();
            $marriage_certificate->move(public_path("documents/file"), $marriage_certificate_name);

            DB::table('documents')->where(
                'fID',
                Auth::user()->fID
            )->update(
                [
                    'marriage_certificate' => $marriage_certificate_name,
                ]
            );

            DB::table('document_statuses')->where(
                'fID',
                Auth::user()->fID
            )->update(
                [
                    'marriage_certificate' => 'UPDATED',
                ]
            );
        }

        if ($request->file('admission_letter') != '') {
            $admission_letter = $request->file('admission_letter');
            $admission_letter_name = rand() . "." . $request->file('admission_letter')->extension();
            $admission_letter->move(public_path("documents/file"), $admission_letter_name);

            DB::table('documents')->where(
                'fID',
                Auth::user()->fID
            )->update(
                [
                    'admission_letter' => $admission_letter_name,
                ]
            );

            DB::table('document_statuses')->where(
                'fID',
                Auth::user()->fID
            )->update(
                [
                    'admission_letter' => 'UPDATED',
                ]
            );
        }

        if ($request->file('application_form') != '') {
            $application_form = $request->file('application_form');
            $application_form_name = rand() . "." . $request->file('application_form')->extension();
            $application_form->move(public_path("documents/file"), $application_form_name);

            DB::table('documents')->where(
                'fID',
                Auth::user()->fID
            )->update(
                [
                    'application_form' => $application_form_name,
                ]
            );

            DB::table('document_statuses')->where(
                'fID',
                Auth::user()->fID
            )->update(
                [
                    'application_form' => 'UPDATED'
                ]
            );
        }

        if ($request->file('transcript') != '') {
            $transcript = $request->file('transcript');
            $transcript_name = rand() . "." . $request->file('transcript')->extension();
            $transcript->move(public_path("documents/file"), $transcript_name);

            DB::table('documents')->where(
                'fID',
                Auth::user()->fID
            )->update(
                [
                    'transcript' => $transcript_name
                ]
            );

            DB::table('document_statuses')->where(
                'fID',
                Auth::user()->fID
            )->update(
                [
                    'transcript' => 'UPDATED'
                ]
            );
        }

        if ($request['ol_card'] != '')
        {
            DB::table('documents')->where(
                'fID',
                Auth::user()->fID
            )->update(
                [
                    'ol_card' => $request['ol_card']
                ]
            );

            DB::table('document_statuses')->where(
                'fID',
                Auth::user()->fID
            )->update(
                [
                    'ol_card' => 'UPDATED',
                ]
            );
        }

        // DB::table('documents')->where(
        //     'fID', Auth::user()->fID
        // )->update(
        //     [
        //         'passport' => $passport_name,
        //         'ol_certificate' => $ol_certificate_name,
        //         'ol_card' => $request['ol_card'],
        //         'ufd_hnd_certificate' => $ufdhnd_certificate_name,
        //         'rhd_diploma_certificate' => $rhddiploma_certificate_name,
        //         'nysc_exemption_certificate' => $nyscexemption_certificate_name,
        //         'clearnce_certificate_fupre' => $clearnce_certificate_fupre_name,
        //         'birth_certificate' => $birth_certificate_name,
        //         'state_of_origin_certificate' => $state_of_origin_certificate_name,
        //         'marriage_certificate' => $marriage_certificate_name,
        //         'admission_letter' => $admission_letter_name,
        //         'application_form' => $application_form_name,
        //         'transcript' => $transcript_name
        //     ]
        // );

        // DB::table('document_statuses')->where(
        //     'fID', Auth::user()->fID
        // )->update(
        //     [
        //         'passport' => 'UPLOADED',
        //         'ol_certificate' => 'UPLOADED',
        //         'ol_card' => 'UPLOADED',
        //         'ufd_hnd_certificate' => 'UPLOADED',
        //         'rhd_diploma_certificate' => 'UPLOADED',
        //         'nysc_exemption_certificate' => 'UPLOADED',
        //         'clearnce_certificate_fupre' => 'UPLOADED',
        //         'birth_certificate' => 'UPLOADED',
        //         'state_of_origin_certificate' => 'UPLOADED',
        //         'marriage_certificate' => 'UPLOADED',
        //         'admission_letter' => 'UPLOADED',
        //         'application_form' => 'UPLOADED',
        //         'transcript' => 'UPLOADED'
        //     ]
        // );

        DB::table('clearance_statuses')->where(
            'fID',
            Auth::user()->fID
        )->update(
            [
                'document' => 'UPDATED'
            ]
        );

        return back()->withStatus(__('Your Changes Have Been Made And Will Be Looked Into'));
    }
    
}
