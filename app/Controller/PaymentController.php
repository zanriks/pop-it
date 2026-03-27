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
        $registrationId = $request->get('id');

        if (!$registrationId) {
            app()->route->redirect('/profile/my_bookings');
            return '';
        }

        $registration = Registration::find($registrationId);

        if (!$registration) {
            app()->route->redirect('/profile/my_bookings');
            return '';
        }

        $payment = null;
        if ($registration->paymentId){
            $payment = Payment::find($registration->paymentId);
        }

        if ($request->method === 'POST') {
            $data = $request->all();

            if ($registration && ($registration->status === 'awaiting' || $registration->status === 'unpaid')) {

                $paymentData = [
                    'accrualAmount' => $data['accrualAmount'],
                    'paidAmount' => $data['paidAmount'],
                    'paymentDate' => date('Y-m-d H:i:s'),
                    'paymentType' => $data['paymentType'],
                    'paymentStatus' => 'paid',
                    'paymentPeriod' => date('Y-m'),
                ];

                if ($payment) {
                    $payment->update($paymentData);
                } else {
                    $payment = Payment::create($paymentData);

                    $registration->update([
                        'paymentId' => $payment->paymentId,
                        'status' => 'paid'
                    ]);
                }
                app()->route->redirect('/profile/my_bookings');
            }
        }
        return new View('payment.pay', ['registration' => $registration, 'payment' => $payment]);
    }
}