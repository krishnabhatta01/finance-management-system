<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    public function index(){
        $roles = Role::all();
       
        return $this->successResponse($roles);
    }

    public function delete($id)
    {
        $item = Role::find($id);
        if (!$item) return $this->errorResponse([], "Failed to delete.");
        $item->delete();
        return  $this->successResponse([], "Record deleted.");
    }
}
