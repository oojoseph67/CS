<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Paystack;
use Auth;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function redirectToGateway()
    {
        try{
            return Paystack::getAuthorizationUrl()->redirectNow();
        }catch(\Exception $e) {
            return Redirect::back()->withMessage(['msg'=>'The paystack token has expired. Please refresh the page and try again.', 'type'=>'error']);
        }        
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();

        // $user_id = Auth::user()->id;
        // $user_role = Auth::user()->role;
        $random_number = intval(rand(0,9).rand(0,9).rand(0,9).rand(0,9));

        // $user = DB::table('users')->where('id' , $user_id)->update(['school_fees_payment'  => 'PAID']);

        

        if($paymentDetails['data']['metadata']['fee_type']  == 'Acceptance Fee')
        {
            $payment = new Payment;

            $user = DB::table('users')->where('fID' , $paymentDetails['data']['metadata']['fID'])->update(['acceptance_fee_status'  => 'PAID']);

            $payment->fID = $paymentDetails['data']['metadata']['fID'];
            $payment->first_name = $paymentDetails['data']['metadata']['first_name'];
            $payment->last_name = $paymentDetails['data']['metadata']['last_name'];
            $payment->email = $paymentDetails['data']['metadata']['email'];
            $payment->session = $paymentDetails['data']['metadata']['session'];
            $fee_type = $payment->fee_type = 'Acceptance Fee';
            $payment->status = $paymentDetails['data']['status'];
            $order_number = $payment->order_number = $random_number;
            $payment->order_date = $paymentDetails['data']['paid_at'];

            $payment->save();

            return view('students.invoice', [
                'first_name' => $paymentDetails['data']['metadata']['first_name'],
                'last_name' => $paymentDetails['data']['metadata']['last_name'],
                'email' => $paymentDetails['data']['metadata']['email'],
                'session' => $paymentDetails['data']['metadata']['session'],
                'fID' => $paymentDetails['data']['metadata']['fID'],
                'fee_type' => $fee_type,
                'status' => $paymentDetails['data']['status'],
                'order_number' => $order_number,
                'order_date' => $paymentDetails['data']['paid_at'],
                'amount' => $paymentDetails['data']['amount'],
            ]);

        }elseif($paymentDetails['data']['metadata']['fee_type']  == 'Prospectus Fee'){

            $payment = new Payment;

            $user = DB::table('users')->where('fID' , $paymentDetails['data']['metadata']['fID'])->update(['prospectus_fee_status'  => 'PAID']);

            $payment->fID = $paymentDetails['data']['metadata']['fID'];
            $payment->first_name = $paymentDetails['data']['metadata']['first_name'];
            $payment->last_name = $paymentDetails['data']['metadata']['last_name'];
            $payment->email = $paymentDetails['data']['metadata']['email'];
            $payment->session = $paymentDetails['data']['metadata']['session'];
            $fee_type = $payment->fee_type = 'Prospectus Fee';
            $payment->status = $paymentDetails['data']['status'];
            $order_number = $payment->order_number = $random_number;
            $payment->order_date = $paymentDetails['data']['paid_at'];

            $payment->save();

            return view('students.invoice', [
                'first_name' => $paymentDetails['data']['metadata']['first_name'],
                'last_name' => $paymentDetails['data']['metadata']['last_name'],
                'email' => $paymentDetails['data']['metadata']['email'],
                'session' => $paymentDetails['data']['metadata']['session'],
                'fID' => $paymentDetails['data']['metadata']['fID'],
                'fee_type' => $fee_type,
                'status' => $paymentDetails['data']['status'],
                'order_number' => $order_number,
                'order_date' => $paymentDetails['data']['paid_at'],
                'amount' => $paymentDetails['data']['amount'],
            ]);

        }elseif($paymentDetails['data']['metadata']['fee_type']  == 'Department Fee'){

            $payment = new Payment;

            $user = DB::table('users')->where('fID' , $paymentDetails['data']['metadata']['fID'])->update(['department_fee_status'  => 'PAID']);

            $payment->fID = $paymentDetails['data']['metadata']['fID'];
            $payment->first_name = $paymentDetails['data']['metadata']['first_name'];
            $payment->last_name = $paymentDetails['data']['metadata']['last_name'];
            $payment->email = $paymentDetails['data']['metadata']['email'];
            $payment->session = $paymentDetails['data']['metadata']['session'];
            $fee_type = $payment->fee_type = 'Department Fee';
            $payment->status = $paymentDetails['data']['status'];
            $order_number = $payment->order_number = $random_number;
            $payment->order_date = $paymentDetails['data']['paid_at'];

            $payment->save();

            return view('students.invoice', [
                'first_name' => $paymentDetails['data']['metadata']['first_name'],
                'last_name' => $paymentDetails['data']['metadata']['last_name'],
                'email' => $paymentDetails['data']['metadata']['email'],
                'session' => $paymentDetails['data']['metadata']['session'],
                'fID' => $paymentDetails['data']['metadata']['fID'],
                'fee_type' => $fee_type,
                'status' => $paymentDetails['data']['status'],
                'order_number' => $order_number,
                'order_date' => $paymentDetails['data']['paid_at'],
                'amount' => $paymentDetails['data']['amount'],
            ]);

        }elseif($paymentDetails['data']['metadata']['fee_type']  == 'School Fee'){

            $payment = new Payment;

            $user = DB::table('users')->where('fID' , $paymentDetails['data']['metadata']['fID'])->update(['school_fee_status'  => 'PAID']);

            $payment->fID = $paymentDetails['data']['metadata']['fID'];
            $payment->first_name = $paymentDetails['data']['metadata']['first_name'];
            $payment->last_name = $paymentDetails['data']['metadata']['last_name'];
            $payment->email = $paymentDetails['data']['metadata']['email'];
            $payment->session = $paymentDetails['data']['metadata']['session'];
            $fee_type = $payment->fee_type = 'School Fee';
            $payment->status = $paymentDetails['data']['status'];
            $order_number = $payment->order_number = $random_number;
            $payment->order_date = $paymentDetails['data']['paid_at'];

            $payment->save();

            return view('students.invoice', [
                'first_name' => $paymentDetails['data']['metadata']['first_name'],
                'last_name' => $paymentDetails['data']['metadata']['last_name'],
                'email' => $paymentDetails['data']['metadata']['email'],
                'session' => $paymentDetails['data']['metadata']['session'],
                'fID' => $paymentDetails['data']['metadata']['fID'],
                'fee_type' => $fee_type,
                'status' => $paymentDetails['data']['status'],
                'order_number' => $order_number,
                'order_date' => $paymentDetails['data']['paid_at'],
                'amount' => $paymentDetails['data']['amount'],
            ]);

        }

        

        // $paymentDetails = Paystack::getPaymentData();

        // dd($paymentDetails);
        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want
    }
}
