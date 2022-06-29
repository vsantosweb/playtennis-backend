<?php

namespace App\Http\Controllers\Api\Public\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function customerPreRegistration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:customers',
        ]);

        $phone = str_replace(' ', '', preg_replace("/[^\da-z ]/i", '', $request->phone));

        if (!is_null(Customer::where('phone', $phone)->first())) return $this->outputJSON([], 'Phone already exists', false, 400);
        if ($validator->fails()) return $this->outputJSON([], $validator->errors(), false, 400);

        $customer = Customer::firstOrCreate([
            'name' => ucwords(strtolower($request->name)),
            'email' => strtolower($request->email),
            'phone' => str_replace(' ', '', preg_replace("/[^\da-z ]/i", '', $request->phone)),
            'customer_status_id' => 2,
            'password' => Hash::make('playtennis2021@#!C')
        ]);

        Mail::send('mails.pre_registration', [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ], function ($message) use ($request) {
            $message->from(env('MAIL_FROM_ADDRESS'));
            $message->subject('Pré cadastro');
            $message->to('atendimento@playtennis.com.br');
            // $message->to('souzavito@hotmail.com');
        });

        return $this->outputJSON($customer, 'success', false, 201);
    }
}
