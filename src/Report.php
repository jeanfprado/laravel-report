<?php

namespace Jeanfprado\LaravelReport;

use Barryvdh\DomPDF\Facade\Pdf;

abstract class Report
{
    protected $fileName = 'report';

    public function stream()
    {
        return $this->pdf()->stream("{$this->fileName}.pdf");
    }

    public function download()
    {
        return $this->pdf()->download("{$this->fileName}.pdf");
    }

    protected function pdf()
    {
        return Pdf::loadView($this->view, $this->toArray());
    }
}
