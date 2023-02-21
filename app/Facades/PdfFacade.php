<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class PdfFacade extends Facade
{
    /**
     * Return the facade name accessor
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'App\PDF\Dompdf';
    }
}
