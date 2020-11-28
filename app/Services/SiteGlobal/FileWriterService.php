<?php

namespace App\Services\SiteGlobal;

use App\Services\BaseService;
use Exception;

/**
 * Functionality for writing to files
 */
class FileWriterService extends BaseService
{

    /**
     * Write value to ENV variable
     *
     * @param string $variable
     * @param string $value
     * @return void
     */
    public static function envWrite(string $variable, string $value) {
        $path = base_path() . '/.env';
        $env_file_contents = file_get_contents($path) or die("Unable to open file!");

        $lines = explode("\n", $env_file_contents);
        $found = false;
        foreach($lines as $line) {
            if ($line === '') continue;
            if (strpos($line, $variable . '=') !== false) {
                $found = true;
                $env_file_contents = str_replace($line, "{$variable}={$value}", $env_file_contents);
                break;
            }
        }

        if (!$found) {
            $env_file_contents .= "\n{$variable}={$value}\n";
        }

        file_put_contents($path, $env_file_contents);
    }
}
