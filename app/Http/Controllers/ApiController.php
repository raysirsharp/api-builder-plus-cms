<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Exception;

/**
 * Class APIController to extend other API controller classes from.
 *
 */
class APIController extends Controller
{
    /**
     * Toggle if this is an API controller or not.
     *
     * @var boolean
     */
    const IS_API = true;

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
}
