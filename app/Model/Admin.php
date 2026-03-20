<?php
//
//namespace Model;
//
//use Illuminate\Database\Eloquent\Model;
//
//class Admin extends Model
//{
//    public function findIdentity(int $id)
//    {
//        return self::where('id', $id)->first();
//    }
//    public function attemptIdentity(array $credentials)
//    {
//        return self::where(['login' => $credentials['login'],
//            'password' => md5($credentials['password'])])->first();
//    }
//}