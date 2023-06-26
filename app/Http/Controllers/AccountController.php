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

    public function pdf_download(){
        $tableData = Account::all();

        $pdf = FacadePdf::loadView('pdf.table', ['tableData' => $tableData]);

        return $pdf->download('table.pdf');
    }
}
