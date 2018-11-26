<?php

// FileController.php

namespace App\Http\Controllers;
use PDF;
use App\Project;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function store(Request $request)
    {
       $request->validate([
        'title' => 'required:max:255',
        'overview' => 'required',
        'price' => 'required|numeric'
      ]);

      auth()->user()->files()->create([
        'title' => $request->get('title'),
        'overview' => $request->get('overview'),
        'price' => $request->get('price')
      ]);

      return back()->with('message', 'Your file is submitted Successfully');
    }
    

    function generate_pdf($id,$file) {

      $pdf = new \Mpdf\Mpdf();
      $pdf->SetImportUse();
      //$pagecount = $pdf->SetSourceFile(public_path("/uploads/181/pdfview4.pdf"));
      $pagecount = $pdf->SetSourceFile(public_path("uploads/".$id.'/'.$file));
        for ($i=1; $i<=($pagecount); $i++) {
          $pdf->AddPage();
          $import_page = $pdf->ImportPage($i);
          $pdf->UseTemplate($import_page);
          $pdf->SetWatermarkText('SIN VALOR - MUVH');
          //$pdf->SetWatermarkImage(public_path("img/logo.png"));
          $pdf->showWatermarkText = true;
          //$pdf->showWatermarkImage = true;
      }
      $pdf->Output();
 
    }

    function github() {

      //return \PDF::loadFile('http://www.github.com')->stream('github.pdf');
        //$data=[];
        $title="Tablero";
        $projects = Project::all();
        view()->share('projects',$projects);
        view()->share('title',$title);
        $pdf = PDF::loadView('dashboard.index');
        
        $pdf->Output();
        //return $pdf->download('invoice.pdf');
        //return PDF::loadFile('http://www.github.com')->inline('github.pdf');
        //$tabger01 = TABGER01::all();
        //view()->share('tabger01',$tabger01);
        //$pdf = PDF::loadView('pdf.pdfview');
        //return $pdf->download('invoice.pdf');
 
    }

    
}