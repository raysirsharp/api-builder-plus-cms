<?php

namespace App\Services\SetupWizard;

use App\Services\BaseService;
use App\Models\GlobalSettings;
use Illuminate\Http\Request;
use App\Services\SiteGlobal\FileWriterService;
use Illuminate\Support\Facades\Artisan;
use Exception;

/**
 * Functionality for Setup Wizard
 */
class SetupWizardService extends BaseService
{

    private $base_step = 1;

    /**
     * Check if the app has been configured yet
     *
     * @return boolean
     */
    public function appNeedsConfigured() {
        try {
            $settings = GlobalSettings::first();
            if ($settings->setup_complete) return false;
        }
        catch(Exception $e) {
            return true;
        }
        return true;
    }

    /**
     * Check what stage configuration is on
     *
     * @return integer
     */
    public function getConfigurationStep() {
        try {
            $settings = GlobalSettings::first();
            return $settings->setup_progress;
        }
        catch(Exception $e) {
            return $this->base_step;
        }
        return $this->base_step;
    }


    /**
     * Check what stage configuration is on
     *
     * @param integer $step_number
     * @return string
     */
    public function getConfigurationStepView($step_number) {
        switch($step_number) {
            case $this->base_step:
                return 'start';
            default:
                abort(404);
        }
    }

    /**
     * Master switch for getting wizard step data
     *
     * @param integer $step_number
     * @return void
     */
    public function getConfigurationStepData($step_number) {
        try {
            $settings = GlobalSettings::first();

            switch($step_number) {
                case $this->base_step:
                    return [
                        'database_name' => env('DB_DATABASE'),
                        'database_user_name' => env('DB_USERNAME'),
                        'database_password' => env('DB_PASSWORD'),
                    ];
                default:
                    abort(404);
            }
        }
        catch(Exception $e) { return []; }
    }

    /**
     * Master switch for performing wizard step submit
     *
     * @param Request $request
     * @param integer $step_number
     * @return void
     */
    public function submitConfigurationStep(Request $request, $step_number) {
        switch($step_number) {
            case $this->base_step:
                return $this->databaseInitialize($request);
            default:
                abort(404);
        }
    }

    /**
     * Initialize the database for Development
     *
     * @param Request $request
     * @return void
     */
    public function databaseInitialize(Request $request) {
        // write database creds to ENV
        FileWriterService::envWrite('DB_DATABASE', $request->database_name);
        FileWriterService::envWrite('DB_USERNAME', $request->database_user_name);
        FileWriterService::envWrite('DB_PASSWORD', $request->database_password);

        // migrate database
        try {
            Artisan::call('cache:clear');
            Artisan::call('migrate:fresh');
        }
        catch(Exception $e) {
            throw new Exception('We failed to connect to MYSQL, please check your credentials and make sure MYSQL is running and try again.');
        }

    }

}
