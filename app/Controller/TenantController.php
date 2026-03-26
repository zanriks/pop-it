<?php

namespace Controller;

use Model\Tenant;
use Src\Request;
use Src\View;

class TenantController
{
    public function createTenant(Request $request): string
    {
        if ($request->method === 'POST' && Tenant::create($request->all())){
            app()->route->redirect('/');
        }
        return new View('site.create_tenant');
    }
}