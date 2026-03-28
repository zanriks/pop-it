<?php

namespace Middlewares;

use Framework\Request;

class TrimMiddleware
{
    public function handle(Request $request) {
        foreach ($request->all() as $key => $value) {
            $request->set($key, is_string($value) ? trim($value) : $value);
        }
        return $request;
    }
}