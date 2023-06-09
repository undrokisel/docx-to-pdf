<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

use Illuminate\Support\Facades\Storage;

class ConvertController extends Controller
{

    public function index()
    {
        return view("docx_to_pdf");
    }

    public function convert(Request $request)
    {
        //        if ($request->isMethod('post') && $request->file('userfile')) {
        //            $request->validate([
        //                'userfile' => 'mimes:docx',
        //            ]);
        //    }


        $file = $request->file('userfile');
        $fileName = $file->getClientOriginalName();
        $filenameWithoutExtention = substr($fileName, 0, strrpos($fileName, '.'));
        $destination_path = public_path('/');

        $file->move($destination_path, $fileName);
        $domPdfPath = base_path('vendor/dompdf/dompdf');
        \PhpOffice\PhpWord\Settings::setPdfRendererPath($domPdfPath);
        \PhpOffice\PhpWord\Settings::setPdfRendererName('DomPDF');

        $content = \PhpOffice\PhpWord\IOFactory::load(public_path($fileName));

        $PDFWriter = \PhpOffice\PhpWord\IOFactory::createWriter($content, 'PDF');
        $PDFWriter->save(public_path('result.pdf'));

        return response()->download(public_path('result.pdf'), $filenameWithoutExtention . '-result.pdf');
    }
}