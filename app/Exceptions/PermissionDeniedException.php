<?php


namespace App\Exceptions;
use Exception;

class PermissionDeniedException extends Exception
{
    /**
     * ValidationExeption constructor.
     */
    public function __construct($message)
    {
        parent::__construct($message);

    }

    /**
     * Report the exception.
     *
     * @return void
     */
    public function report()
    {
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {

    }

}