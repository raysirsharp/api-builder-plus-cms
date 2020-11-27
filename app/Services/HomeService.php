<?php

namespace App\Services;

use App\Models\GlobalSettings;
use Auth, Exception;


/**
 * Functionality for deciding where to route user on homepage
 */
class HomeService
{
    /**
     * Check if the app has been configured yet
     *
     * @return boolean
     */
    public function appNeedsConfigured() {
        try {
            $settings = GlobalSettings::first();
            if ($settings->setup_complete) return true;
        }
        catch(Exception $e) {
            return false;
        }
        return false;
    }

    /**
     * Check what stage configuration is on
     *
     * @return boolean
     */
    public function getConfigurationStep() {
        try {
            $settings = GlobalSettings::first();
            return $settings->setup_progress;
        }
        catch(Exception $e) {
            return 0;
        }
        return 0;
    }

}
