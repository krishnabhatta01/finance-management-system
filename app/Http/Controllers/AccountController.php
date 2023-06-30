<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Http\Request;
use PDF;


class AccountController extends Controller
{
    public function index()
    {
        return $this->successResponse(Account::all());
    }

    public function save(Request $request)
    {
        $fields = $request->validated();
        $setFields = [
            "name" => $fields["name"],
            "email" => $fields["email"],
            "role" => $fields["role"],
        ];
        if (@$request->avatar && str_contains($request->avatar, "base64")) {
            $setFields["avatar"] = $this->saveFile($request->avatar);
        }
        if (isset($fields["password"])) $setFields["password"] = bcrypt($fields["password"]);
        $item = User::updateOrCreate([
            "id" => $fields["id"] ?? null
        ], $setFields);
        return $this->successResponse($item);
    }

    public function delete($id)
    {
        $item = User::find($id);
        if (!$item) return $this->errorResponse([], "Failed to delete.");
        $item->delete();
        return  $this->successResponse([], "Record deleted.");
    }
}
