<?php

namespace Controller;

use Model\Registration;
use Model\Room;
use Model\Tenant;
use Src\Auth\Auth;
use Src\Request;
use Src\Validator\Validator;
use Src\View;

class RegistrationController
{
    public function create(Request $request): string
    {
        $rooms = Room::whereColumn('numberOfTenants', '<', 'totalBeds')->get();

        if ($request->method === 'POST') {
            $data = $request->all();

            $currentUser = Auth::user();
            $tenant = Tenant::where('userId', $currentUser->id)->first();

            if (!$tenant) {
                return new View('registration.create', [
                    'errors' => ['tenant' => 'Вы не зарегистрированы как арендатор'],
                    'rooms' => $rooms,
                ]);
            }

            $data['tenantId'] = $tenant->tenantId;

            $validator = new Validator($data, [
                'roomId' => ['required'],
                'checkInDate' => ['required'],
                'checkOutDate' => ['required'],
            ], [
                'required' => 'Поле :field обязательно'
            ]);

            if ($validator->fails()) {
                return new View('registration.create', ['errors' => $validator->errors(), 'rooms' => $rooms]);
            }

            $room = Room::where('roomId', $data['roomId'])->first();
            if(!$room) {
                return new View('registration.create', [
                    'errors' => ['roomId' => 'Комната не найдена'],
                    'rooms' => $rooms,
                    'old' => $data
                ]);
            }

            $activeBookingCount = Registration::where('roomId', $room->roomId)->whereIn('status', ['paid', 'unpaid', 'awaiting'])->count();

            $totalOccupied = $room->numberOfTenants + $activeBookingCount;

            if ($totalOccupied >= $room->totalBeds) {
                return new View('registration.create', [
                    'errors' => ['roomId' => 'В комнате нет свободных мест (учтены текущие брони)'],
                    'rooms' => $rooms,
                    'old' => $data
                ]);
            }

            $registration = Registration::create([
                'roomId' => $data['roomId'],
                'tenantId' => $tenant->tenantId,
                'checkInDate' => $data['checkInDate'],
                'checkOutDate' => $data['checkOutDate'],
                'orderDate' => date('Y-m-d H:i:s'),
                'orderNumber' => 'ORD-' . time(),
                'status' => 'awaiting',
            ]);

            if ($registration) {
                app()->route->redirect('/profile/my_bookings');
            } else {
                return new View('registration.create', [
                    'errors' => ['Не удалось создать бронь.'],
                    'rooms' => $rooms,
                    'old' => $data
                ]);
            }
        }
        return new View('registration.create', ['rooms' => $rooms, 'errors' => []]);
    }
    // метод для заселения
    public function checkIn(Request $request): string
    {
        $id = $request->get('registrationId');
        $reg = Registration::find($id);

        if ($reg && $reg->status === 'confirmed' || $reg->status === 'paid') {
            $reg->update([
                'status' => 'active',
            ]);

            $room = Room::find($reg->roomId);
            if ($room) {
                $room->increment('numberOfTenants');
            }
        }

        app()->route->redirect('/admin/registrations');
        return '';
    }

    // метод для выселения
    public function checkOut(Request $request): string
    {
        $id = $request->get('registrationId');
        $reg = Registration::find($id);

        if ($reg && $reg->status === 'active') {
            $reg->update([
                'status' => 'completed',
                'actualCheckOutDate' => date('Y-m-d H:i:s')
            ]);

            $room = Room::find($reg->roomId);
            if ($room) {
                $room->decrement('numberOfTenants');
            }
        }

        app()->route->redirect('/admin/registrations');
        return '';
    }
    public function myBookings(): string
    {
        $currentUser = Auth::user();
        $tenant = Tenant::where('userId', $currentUser->id)->first();

        if (!$tenant) {
            return new View('registration.my_bookings', ['bookings' => []]);
        }

        $bookings = Registration::where('tenantId', $tenant->tenantId)->with(['room.building'])->orderBy('orderDate', 'desc')->get();
        return new View('registration.my_bookings', ['bookings' => $bookings]);
    }

    public function cancelBooking(Request $request): string
    {
        $registrationId = $request->get('registrationId');

        if (!$registrationId) {
            app()->route->redirect('/profile/my_bookings');
            return '';
        }

        $currentUser = Auth::user();
        $tenant = Tenant::where('userId', $currentUser->id)->first();

        if (!$tenant) {
            app()->route->redirect('/profile/my_bookings');
            return '';
        }

        $booking = Registration::find($registrationId);

        if ($booking && $booking->tenantId === $tenant->tenantId && in_array($booking->status, ['awaiting','confirmed','active','completed','cancelled'])) {
            $booking->update(['status' => 'cancelled']);
        }
        app()->route->redirect('/profile/my_bookings');
        return '';
    }
}