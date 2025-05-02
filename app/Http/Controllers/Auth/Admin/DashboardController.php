<?php
namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;


class DashboardController extends Controller
{
    public function stats()
    {
        return view('back.admin.stats');
    }
}
