<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
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

    public function save(RoleRequest $request)
    {
        $fields = $request->validated();
        $setFields = [
            "name" => $fields["name"],
        ];

        $item = Role::updateOrCreate([
            "id" => $fields["id"] ?? null
        ], $setFields);
        return $this->successResponse($item);
    }

}
