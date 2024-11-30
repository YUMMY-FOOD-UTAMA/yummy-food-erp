<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SalesMappingController extends Controller
{
    public function index()
    {
        return view('crm.sales_mapping.index');
    }
}
