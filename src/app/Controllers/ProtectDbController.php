<?php

namespace Pranthokumar\ProtectDb\App\Controllers;

use App\Http\Controllers\Controller;
use Pranthokumar\ProtectDb\App\Facades\ProtectDb;
use Pranthokumar\ProtectDb\App\Jobs\ProtectDbJob;

class ProtectDbController extends Controller
{
    public function index()
    {
        $totalBackups = ProtectDb::getTotalBackups();

        return view('protect-db::index', compact('totalBackups'));
    }

    public function protect()
    {
        ProtectDbJob::dispatch();
        return redirect()->back()->with('success', 'Database backup successfully');

    }
}