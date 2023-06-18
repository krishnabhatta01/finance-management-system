<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
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

    public function saveFile($base64)
    {
        $split = explode(",",$base64);
        $base64 = $split[1];
        $extension = explode("/",explode(";",$split[0])[0])[1];
        $base64 = str_replace(' ', '+', $base64);
        $fileName = time().".".$extension;
        $path = public_path().'/uploads/'.$fileName;
        file_put_contents($path, base64_decode($base64));
        return '/uploads/'.$fileName;
    }
}
