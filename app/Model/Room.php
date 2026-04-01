<?php

namespace Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $primaryKey = 'roomId';
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'buildingId',
        'roomNumber',
        'floor',
        'roomType',
        'totalBeds',
        'numberOfTenants'
    ];
    public function building()
    {
        return $this->belongsTo(Building::class, 'buildingId', 'buildingId');
    }

    public static function findAvailableSeatsByFloor(int $floor, ?string $date = null): array
    {
        // Получаем все комнаты на указанном этаже
        $rooms = self::where('floor', $floor)->get();

        $availableSeats = [];

        foreach ($rooms as $room) {
            // Рассчитываем свободные места
            $freeBeds = $room->totalBeds - $room->numberOfTenants;

            // Если указана дата, проверяем активные регистрации на эту дату
            if ($date) {
                $activeRegistrations = Registration::where('roomId', $room->roomId)
                    ->where('status', 'active')
                    ->where(function($query) use ($date) {
                        $query->where('checkInDate', '<=', $date)
                            ->where('checkOutDate', '>=', $date);
                    })
                    ->count();

                // Пересчитываем свободные места с учетом регистраций на конкретную дату
                $freeBeds = $room->totalBeds - $activeRegistrations;
            }

            $availableSeats[] = [
                'roomId' => $room->roomId,
                'roomNumber' => $room->roomNumber,
                'floor' => $room->floor,
                'roomType' => $room->roomType,
                'totalBeds' => $room->totalBeds,
                'currentTenants' => $room->numberOfTenants,
                'freeBeds' => max(0, $freeBeds),
                'isAvailable' => $freeBeds > 0,
                'buildingId' => $room->buildingId
            ];
        }

        // Сортируем комнаты: сначала свободные, затем по номеру комнаты
        usort($availableSeats, function($a, $b) {
            if ($a['isAvailable'] === $b['isAvailable']) {
                return strcmp($a['roomNumber'], $b['roomNumber']);
            }
            return $b['isAvailable'] <=> $a['isAvailable'];
        });

        return $availableSeats;
    }
    public static function getFloorStats(int $floor, ?string $date = null): array
    {
        $rooms = self::findAvailableSeatsByFloor($floor, $date);

        $totalRooms = count($rooms);
        $availableRooms = count(array_filter($rooms, function($room) {
            return $room['isAvailable'];
        }));

        $totalBeds = array_sum(array_column($rooms, 'totalBeds'));
        $totalFreeBeds = array_sum(array_column($rooms, 'freeBeds'));
        $totalOccupiedBeds = $totalBeds - $totalFreeBeds;

        return [
            'floor' => $floor,
            'totalRooms' => $totalRooms,
            'availableRooms' => $availableRooms,
            'totalBeds' => $totalBeds,
            'occupiedBeds' => $totalOccupiedBeds,
            'freeBeds' => $totalFreeBeds,
            'occupancyRate' => $totalBeds > 0 ? round(($totalOccupiedBeds / $totalBeds) * 100, 2) : 0
        ];
    }
}