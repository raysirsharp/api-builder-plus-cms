<?php

namespace App\Http\Controllers\SetupWizard;

use App\Http\Controllers\Controller;
use App\Services\SetupWizard\SetupWizardService;
use Exception;
use Illuminate\Http\Request;

class SetupWizardController extends Controller
{

    /**
     * A list of Service class names that this Controller will connect to.
     *
     * @var array
     */
    protected $service_classes = [
        'setup-wizard' => SetupWizardService::class,
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware(function ($request, $next) {
            if ($this->service()->appNeedsConfigured()) {
                return $next($request);
            }
            return abort(403, 'Your app has already been configured.');
        });
    }

   /**
    * Show View For Configuration Step
    *
    * @param integer $step_number
    * @return view
    */
    public function showStep($step_number)
    {
        $data = $this->service()->getConfigurationStepData($step_number);
        $view = $this->service()->getConfigurationStepView($step_number);
        return view("setup_wizard.{$view}")->with(['data' => $data, 'step' => $step_number]);
    }

    /**
    * Submit Data For Configuration Step
    *
    * @param Request $request
    * @param integer $step_number
    * @return view
    */
    public function submitStep(Request $request, $step_number) {
        try {
            $this->service()->submitConfigurationStep($request, $step_number);
            return redirect(route('setup-wizard', $step_number + 1));
        }
        catch(Exception $e) {
            return $this->htmlError($e);
        }
    }
}
