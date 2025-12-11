<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Admin\Services\AdminDataTableService;

class AdminDataTableController extends Controller
{


    public function approvedProducts(AdminDataTableService $dataTableService)
    {
        return $dataTableService->approvedProducts();
    }

    public function unapprovedProducts(AdminDataTableService $dataTableService)
    {
        return $dataTableService->unapprovedProducts();
    }

    public function support(AdminDataTableService $dataTableService)
    {
        return $dataTableService->support();
    }

    public function users(AdminDataTableService $dataTableService)
    {
        return $dataTableService->users();
    }

    public function partners(AdminDataTableService $dataTableService)
    {
        return $dataTableService->partners();
    }

    public function newsletter(AdminDataTableService $dataTableService)
    {
        return $dataTableService->newsletter();
    }

    public function leads(AdminDataTableService $dataTableService, Request $request)
    {
        return $dataTableService->leads($request);
    }

    public function auditLogs(AdminDataTableService $dataTableService)
    {
        return $dataTableService->auditLogs();
    }

    public function auditLogPopover($id, AdminDataTableService $dataTableService)
    {
        return $dataTableService->auditLogPopover($id);
    }

    public function auditLogErrorTrace($id, AdminDataTableService $dataTableService)
    {
        return $dataTableService->auditLogErrorTrace($id);
    }

    public function potentialCustomers(AdminDataTableService $dataTableService)
    {
        return $dataTableService->potentialCustomers();
    }
}
