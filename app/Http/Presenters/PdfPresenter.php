<?php

namespace App\Http\Presenters;

use App\Core\PresenterCore;
use App\Factories\ModelFactory;
use App\Factories\FilterFactory;
use Illuminate\Http\Request;
use PdfMerger;
use PDF;

class PdfPresenter extends PresenterCore
{
  public function pdf()
  {
    // $pdf = PdfMerger::addPDF('samplepdfs/one.pdf');
    // $pdf = PdfMerger::addPDF('samplepdfs/two.pdf');
    //
    // PdfMerger::merge('download', 'samplepdfs/TEST2.pdf');

    // $pdf = PDF::loadView('htmltopdfview');
    PDF::loadView( 'htmltopdfview')->save('samplepdfs/download.pdf')->stream();
    // return $pdf->download('download.pdf');
  }
}
