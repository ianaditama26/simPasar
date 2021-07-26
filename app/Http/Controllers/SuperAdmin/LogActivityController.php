<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;

class LogActivityController extends Controller
{
    public function index()
    {
        return view('logActivity.index');
    }

    public function dtLogActivity()
    {
        // Get data
        $activities = Activity::all();
        // Return datatable
        return \datatables()->of($activities)
        ->addColumn('attributes', function($activities){
                
            return view('logActivity.activityLog', [
                'activities' => $activities
            ]);
        })
        ->rawColumns(['attributes'])
        ->addIndexColumn()
        ->toJson();
    }
}
