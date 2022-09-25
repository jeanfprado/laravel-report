<?php

namespace Jeanfprado\LaravelReport;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class Report
{
    protected $request;

    protected $renderType = 'download';

    protected $fileName = 'report';

    protected $view = '';

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function render()
    {
        $pdf = Pdf::loadView($this->view, ['rows' => $this->getData()]);
        return $pdf->{$this->renderType}("{$this->fileName}.pdf");
    }

    protected function getData()
    {
        return $this->toCollection();
    }
}
