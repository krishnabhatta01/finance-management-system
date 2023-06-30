<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

   

    /* public function index()
    {
        
        return $this->successResponse(User::all());
    }

    public function show($id)
    {
        $item = User::find($id);
        if(!$item) return $this->errorResponse([],"Record not found.");
        return $this->successResponse($item);
    }

    public function save(UserRequest $request)
    {
        $fields = $request->validated();
        $setFields = [
            "name"=>$fields["name"],
            "email"=>$fields["email"],
            "role"=>$fields["role"],
        ];
        if(@$request->avatar && str_contains($request->avatar,"base64")){
            $setFields["avatar"] = $this->saveFile($request->avatar);
        }
        if(isset($fields["password"])) $setFields["password"] = bcrypt($fields["password"]);
        $item = User::updateOrCreate([
            "id"=>$fields["id"] ?? null
        ],$setFields);
        return $this->successResponse($item);
    }

    public function delete($id)
    {
        $item = User::find($id);
        if(!$item) return $this->errorResponse([],"Failed to delete.");
        $item->delete();
        return  $this->successResponse([],"Record deleted.");
    }
 */
    
}
