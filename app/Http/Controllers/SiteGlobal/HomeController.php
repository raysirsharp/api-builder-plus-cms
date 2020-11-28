<?php

namespace App\Http\Controllers\SiteGlobal;

use App\Http\Controllers\Controller;
use App\Services\SiteGlobal\HomeService;
use App\Services\SetupWizard\SetupWizardService;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * A list of Service class names that this Controller will connect to.
     *
     * @var array
     */
    protected $service_classes = [
        'home' => HomeService::class,
        'setup-wizard' => SetupWizardService::class,
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // re-route if app needs configured
        if ($this->service('setup-wizard')->appNeedsConfigured()) {
            $step_number = $this->service('setup-wizard')->getConfigurationStep();
            return redirect(route('setup-wizard', $step_number));
        }

        return 'todo: login page';
    }
}
