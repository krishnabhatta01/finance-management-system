<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();

        return $this->successResponse($permissions);
    }

    public function delete($id)
    {
        $item = Permission::find($id);
        if (!$item) return $this->errorResponse([], "Failed to delete.");
        $item->delete();
        return  $this->successResponse([], "Record deleted.");
    }
}
