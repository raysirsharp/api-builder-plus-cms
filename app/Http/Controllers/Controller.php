<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\ValidationException;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Toggle if this is an API controller or not.
     *
     * @var boolean
     */
    const IS_API = false;

    /**
     * A list of Service class names that this controller will connect to.
     *
     * @var array
     */
    protected $service_classes = [];

    /**
     * Instantiated services
     *
     * @var array
     */
    protected $services = [];

    /**
     * Instantiate services based on $service_classes variable
     *
     * @param Application $app
     * @return void
     */
    function __construct()
    {
        //load all repositories for this service
        foreach ($this->service_classes as $key => $class) {
            $this->services[$key] = app()->makeWith($class, ['for_api' => static::IS_API]);
        }
    }

    /**
     * Helper function to interact with service instance
     *
     * @param string $key service identifier. If null, the first service will be grabbed
     * @return ServiceClass
     */
    public function service($key = null)
    {
        if (!$key) {
            $key = array_key_first($this->services);
        }
        if (!isset($this->services[$key])) {
            throw new Exception('Service key ' . $key . ' not found.');
        }
        return $this->services[$key];
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

        if ($err instanceof ValidationException) {
            throw $err; // throw validation errors to laravel framework
        }
        else if ($redirect === null) {
            return redirect()->back()->with('error', $message)->withInput();
        }
        else {
            return redirect($redirect)->with('error', $message)->withInput();
        }
    }
}
