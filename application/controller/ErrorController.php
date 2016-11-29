<?php

/**
 * ErrorController 
 * 
 * @author DartVadius
 */
class ErrorController extends BaseController {
    public function error($exception = '') {
        $param = array ();
        if ($exception->getCode() == 404) {
            $param = array (['404', ['exception' => $exception]]);
            $this->view->render($param);
        } elseif ($exception->getCode() == 403) {
            $param = array (['403', ['exception' => $exception]]);
            $this->view->render($param);
        } elseif ($exception->getCode() == 500) {
            $param = array (['500', ['exception' => $exception]]);
            $this->view->render($param);
        } else {
            $param = array (['error', ['exception' => $exception]]);
            $this->view->render($param);
        }
    }
}
