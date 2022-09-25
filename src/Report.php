<?php

namespace Jeanfprado\LaravelReport;

use Barryvdh\DomPDF\Facade\Pdf;

class Report
{
    protected $renderType = 'download';

    protected $fileName = 'report';

    protected $view = '';

    public function render()
    {
        $pdf = Pdf::loadView($this->view, ['rows' => $this->getData()]);
        return $pdf->{$this->renderType}("{$this->fileName}.pdf");
    }

    protected function getData()
    {
        return $this->collection();
    }
}
