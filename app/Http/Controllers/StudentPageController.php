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

        return view('students.home', [
            'details' => $details,
            'documents' => $documents
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
            'sponsor_gsm' => $request['sponsor_gsm'],
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
            'dept' => $request['department'],
            'mat_no' => $request['mat_no'],
            'programme_of_study' => $request['programme_of_study'],
            'expected_graduation_year' => $request['year_of_graduation']
        ]);

        $store_user->save();

        DB::table('users')->where(
            'fID', $request['fID']
        )->update([
            'personal_form' => 'FILLLED'
        ]);

        return redirect()->route('student.home')->withStatus(__('Hey '. $request['last_name']. ' Congratulations on filling your personal form. Now Please Submit Your Document '. $request['role']));
    }

    public function document(Request $request)
    {
        $request->validate([
            'passport' => ['required', 'mimes:jpeg,png,gif,jpg', 'max:10024'],
            'o/l_certificate' => ['required', 'mimes:pdf,doc,txt,docx', 'max:10024'],
            'ufd/hnd_certificate' => ['required', 'mimes:pdf,doc,txt,docx', 'max:10024'],
            'rhd/diploma_certificate' => ['required', 'mimes:pdf,doc,txt,docx', 'max:10024'],
            'nysc/exemption_certificate' => ['required', 'mimes:pdf,doc,txt,docx', 'max:10024'],
            'clearnce_certificate_fupre' => ['required', 'mimes:pdf,doc,txt,docx', 'max:10024'],
            'birth_certificate' => ['required', 'mimes:pdf,doc,txt,docx', 'max:10024'],
            'state_of_origin_certificate' => ['required', 'mimes:pdf,doc,txt,docx', 'max:10024'],
            'marriage_certificate' => ['required', 'mimes:pdf,doc,txt,docx', 'max:10024'],
            'admission_letter' => ['required', 'mimes:pdf,doc,txt,docx', 'max:10024'],
            'application_form' => ['required', 'mimes:pdf,doc,txt,docx', 'max:10024'],
            'transcript' => ['required', 'mimes:pdf,doc,txt,docx', 'max:10024']
        ]);

        // $name = $request->file('passport')->getClientOriginalName();
        // $extension = $request->file('passport')->extension();

        $passport = $request->file('passport');
        $passport_name = rand().".".$request->file('passport')->extension();
        $passport->move(public_path("documents/passport"), $passport_name);

        $ol_certificate = $request->file('o/l_certificate');
        $ol_certificate_name = rand().".".$request->file('o/l_certificate')->extension();
        $ol_certificate->move(public_path("documents/file"), $ol_certificate_name);

        $ufdhnd_certificate = $request->file('ufd/hnd_certificate');
        $ufdhnd_certificate_name = rand().".".$request->file('ufd/hnd_certificate')->extension();
        $ufdhnd_certificate->move(public_path("documents/file"), $ufdhnd_certificate_name);

        $rhddiploma_certificate = $request->file('rhd/diploma_certificate');
        $rhddiploma_certificate_name = rand().".".$request->file('rhd/diploma_certificate')->extension();
        $rhddiploma_certificate->move(public_path("documents/file"), $rhddiploma_certificate_name);

        $nyscexemption_certificate = $request->file('nysc/exemption_certificate');
        $nyscexemption_certificate_name = rand().".".$request->file('nysc/exemption_certificate')->extension();
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
            'o/l_certificate' => $ol_certificate_name,
            'o/l_card' => $request['o/l_card'],
            'ufd/hnd_certificate' => $ufdhnd_certificate_name,
            'rhd/diploma_certificate' => $rhddiploma_certificate_name,
            'nysc/exemption_certificate' => $nyscexemption_certificate_name,
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
            'o/l_certificate' => 'UPLOADED',
            'o/l_card' => 'UPLOADED',
            'ufd/hnd_certificate' => 'UPLOADED',
            'rhd/diploma_certificate' => 'UPLOADED',
            'nysc/exemption_certificate' => 'UPLOADED',
            'clearnce_certificate_fupre' => 'UPLOADED',
            'birth_certificate' => 'UPLOADED',
            'state_of_origin_certificate' => 'UPLOADED',
            'marriage_certificate' => 'UPLOADED',
            'admission_letter' => 'UPLOADED',
            'application_form' => 'UPLOADED',
            'transcript' => 'UPLOADED'
        ]);

        $store_documment_status->save();  

        DB::table('users')->where(
            'fID', $request['fID']
        )->update([
            'documents' => 'SUBMITTED'
        ]);

        return redirect()->route('student.home')->withStatus(__('Hey '. $request['last_name']. ' Congratulations on Submitting Your Document'));
    }

    public function preliminaryForm(Request $request)
    {
        DB::table('users')->where(
            'fID', $request['fID']
        )->update(
            [
                'lga' => $request['lga'],
            ]
        );
    }
    
}
