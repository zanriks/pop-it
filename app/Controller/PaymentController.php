<?php

namespace Controller;

use Model\Payment;
use Model\Registration;
use Src\Request;
use Src\View;

class PaymentController
{
    public function payBooking(Request $request): string
    {
        if ($request->method === 'POST') {
            $data = $request->all();

            $registration = Registration::find($data['registrationId']);
            if ($registration && $registration->status === 'awaiting') {
                $payment = Payment::create([
                    'registration_id' => $registration->registrationId,
                    'accrualAmount' => $data['amount'],
                    'paidAmount' => $data['amount'],
                    'paymentDate' => date('Y-m-d H:m:s'),
                    'paymentType' => $data['paymentType'],
                    'paymentStatus' => 'paid',
                    'paymentPeriod' => date('Y-m'),
                ]);

                $registration->update([
                    'paymentId' => $payment->paymentId,
                    'status' => 'paid'
                ]);

                app()->route->redirect('/profile/my_bookings');
            }
        }

        $registration = Registration::find($request->get('registrationId'));
        return new View('payment.pay', ['registration' => $registration, 'payment' => $payment]);
    }
}