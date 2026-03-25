<?php

namespace Controller;

use Illuminate\Database\Eloquent\Model;
use Model\Registration;
use Model\Room;
use Model\User;
use Src\Request;

class RegistrationController extends Model
{
    public function register_create(Request $request)
    {
        $rooms = Room::where('numberOfTenants', '<', 'totalBeds');
        $tenants = User::all();

        if ($request->method === 'POST') {
            $data = $request->all();

            if (Registration::create($data)) {
                $room = Room::find($data['roomId']);
                $room->numberOfTenants += 1;
                $room->save();
                app()->route->redirect('/room/booking');
            }
        }
        app()->route->redirect('/room/booking');
    }
}