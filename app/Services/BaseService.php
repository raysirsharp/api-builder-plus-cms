<?php

namespace App\Services;

use App\Models\GlobalSettings;
use Auth, Exception;


/**
 * Base Service for all other services
 * to extend functionality from
 */
class BaseService
{
    /**
     * Instruct the service whether this is for an API controller or not.
     *
     * @var boolean
     */
    protected $for_api;

    /**
     * Instantiate repositories based on $repository_classes variable.
     *
     * @param Application $app
     * @return void
     */
    function __construct($for_api = false)
    {
        //set for API toggle
        $this->for_api = $for_api;
    }
}
