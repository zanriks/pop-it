<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;

class ApiToken extends Model
{
    protected string $table = 'api_tokens';

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
}