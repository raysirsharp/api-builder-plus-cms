<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Output an API response in JSON.
     *
     * @param array $output
     * @param int $status_code
     * @return Response
     */
    protected function apiResponse($output, $status_code = 200)
    {
        if (is_a($output, 'Illuminate\Http\Resources\Json\ResourceCollection')) {
            return $output;
        }

        return Response::json($output, $status_code);
    }

    /**
     * Output an API error response in JSON.
     *
     * @param mixed $err
     * @param int $status_code
     * @return Response
     */
    protected function apiError($err, $status_code = 400)
    {
        if($err instanceof Exception) {
            $message = $err->getMessage();
        }
        else {
            $message = $err;
        }

        return Response::json(['error' => $message], $status_code);
    }

    /**
     * Output an HTML error response.
     *
     * @param mixed $err
     * @param int $status_code
     * @param int $redirect (defaults to redirect back)
     * @return Response
     */
    protected function htmlError($err, $redirect = null)
    {
        if($err instanceof Exception) {
            $message = $err->getMessage();
        }
        else {
            $message = $err;
        }

        if ($redirect === null)
            return redirect()->back()->with('error', $message)->withInput();
        else
            return redirect($redirect)->with('error', $message)->withInput();
    }
}
