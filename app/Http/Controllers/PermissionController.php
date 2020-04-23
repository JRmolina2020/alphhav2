<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Permission;

class PermissionController extends Controller
{


    public function index()
    {
        return view('permission');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getdata(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $permission = DB::table('permissions')
            ->orderBy('id', 'desc')->get();
        return response()->json($permission);
    }
}