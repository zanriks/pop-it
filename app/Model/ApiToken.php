<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;

class ApiToken extends Model
{
    protected $table = 'tokens';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'token'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function createToken(int $userId): string
    {
        $token = bin2hex(random_bytes(32));

        $this->insert([
            'user_id' => $userId,
            'token' => $token,
        ]);

        return $token;
    }
    public function clearToken(string $token)
    {
        return $this->where('token', $token)->delete();
    }
    public function getUserByToken(string $token)
    {
        $tokenData = $this->where('token', $token)->first();

        if (!$tokenData) {
            return null;
        }

        return User::find($tokenData->user_id);
    }
    public function validateToken(string $token): bool
    {
        return $this->where('token', $token)->exists();
    }
}