<?php
namespace App\Exceptions;

use Exception;

class AccessControlException extends Exception {

	public function render($request, Exception $e)
    {
            if($e instanceof AccessControlException)
            {
                    return redirect('dashboard')->with('flash_message', $e->getMessage());
            }

        if ($this->isHttpException($e))
        {
            return $this->renderHttpException($e);
        }
        else
        {
            return parent::render($request, $e);
        }
    }
}