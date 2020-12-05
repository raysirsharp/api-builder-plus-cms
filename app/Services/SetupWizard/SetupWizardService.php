<?php

namespace App\Services\SetupWizard;

use App\Services\BaseService;
use App\Models\GlobalSettings;
use App\Models\User;
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
            case $this->base_step + 1:
                return 'primary-user';
            case $this->base_step + 2:
                return 'public-users';
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

            switch($step_number) {
                case $this->base_step:
                    return [
                        'has_data' => true,
                        'database_name' => env('DB_DATABASE'),
                        'database_user_name' => env('DB_USERNAME'),
                        'database_password' => env('DB_PASSWORD'),
                    ];
                case $this->base_step + 1:
                    $user = User::first();

                    return [
                        'has_data' => true,
                        'user_name' => $user->user_name,
                        'email' => $user->email
                    ];
                default:
                    abort(404);
            }
        }
        catch(Exception $e) { return ['has_data' => false]; }
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
                $this->databaseInitialize($request);
                break;
            case $this->base_step + 1:
                $this->adminInitialize($request);
                $this->incrementStep();
                break;
            default:
                abort(404);
        }
    }

    ///////////////////////
    // PRIVATE FUNCTIONS //
    ///////////////////////

    /**
     * Increment the setup_progress for wizard
     *
     * @return void
     */
    private function incrementStep() {
        $settings = GlobalSettings::first();
        $settings->update(['setup_progress' => $settings->setup_progress + 1]);
    }

    /**
     * SUBMIT STEP #1
     * Initialize the database for Development
     *
     * @param Request $request
     * @return void
     */
    private function databaseInitialize(Request $request) {
        // write database creds to ENV
        FileWriterService::envWrite('DB_DATABASE', $request->database_name);
        FileWriterService::envWrite('DB_USERNAME', $request->database_user_name);
        FileWriterService::envWrite('DB_PASSWORD', $request->database_password);

        // migrate database
        try {
            Artisan::call('cache:clear');
            Artisan::call('migrate:fresh');

            GlobalSettings::create(['setup_progress' => 2]);
        }
        catch(Exception $e) {
            throw new Exception('We failed to connect to MYSQL, please check your credentials and make sure MYSQL is running and try again.');
        }

    }

    /**
     * SUBMIT STEP #2
     * Initialize the primary for Development
     *
     * @param Request $request
     * @return void
     */
    private function adminInitialize(Request $request) {

        //validate
        $request->validate(
            [
                'user_name' => 'required|string|min:3|max:20',
                'email' => 'required|email|max:255',
                'password' => 'required|string|confirmed|min:6|max:20',
            ]
        );

        User::query()->truncate();

        // create user
        $user_data = [
            'user_name' => $request->user_name,
            'email' => $request->email,
            'password' => $request->password,
            'is_api_admin' => true,
            'is_content_admin' => true
        ];
        User::create($user_data);
    }

}
