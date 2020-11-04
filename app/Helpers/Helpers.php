<?php

if(!function_exists('rand_letter')){
    function rand_letter()
    {
        // $int = rand(0,51);
        // $a_z = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        // $rand_letter = $a_z[$int];

        // Upper Case
        // $rand_letter = chr(rand(65,90));

        // Lower Case
        $rand_letter = chr(rand(97,122));
        return $rand_letter;
    }
}

if(!function_exists('distance')){
    /**
     * Retourne la distance en metre ou kilometre (si $unit = 'k') entre deux latitude et longitude fournit
     */
    function distance($lat1, $lng1, $lat2, $lng2, $unit = 'k') {
        $earth_radius = 6378137;   // Terre = sphère de 6378km de rayon
        $rlo1 = deg2rad($lng1);
        $rla1 = deg2rad($lat1);
        $rlo2 = deg2rad($lng2);
        $rla2 = deg2rad($lat2);
        $dlo = ($rlo2 - $rlo1) / 2;
        $dla = ($rla2 - $rla1) / 2;
        $a = (sin($dla) * sin($dla)) + cos($rla1) * cos($rla2) * (sin($dlo) * sin($dlo));
        $d = 2 * atan2(sqrt($a), sqrt(1 - $a));
        //
        $meter = ($earth_radius * $d);
        if ($unit == 'k') {
            return $meter / 1000;
        }
        return $meter;
    }
}

if(!function_exists('diffDateForHumans')){
    function diffDateForHumans($date){
        return \Carbon\Carbon::createFromTimeStamp(strtotime($date))->diffForHumans();
    }
}

if (! function_exists('setEnvironmentValue')) {
    /**
     * Function to set or update .env variable
     *
     * @param array $values
     * @return bool
     */
    function setEnvironmentValue(array $values)
    {
        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);

        if (count($values) > 0) {
            $str .= "\n"; // In case the searched variable is in the last line without \n
            foreach ($values as $envKey => $envValue) {
                $envKey = strtoupper($envKey);
                $keyPosition = strpos($str, "{$envKey}=");
                $endOfLinePosition = strpos($str, "\n", $keyPosition);
                $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);
                $space = strpos($envValue, ' ');
                $envValue = ($space === false) ? $envValue : '"' . $envValue . '"';

                // If key does not exist, add it
                if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
                    $str .= "{$envKey}={$envValue}\n";
                } else {
                    $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
                }
            }
        }

        $str = substr($str, 0, -1);

        if (!file_put_contents($envFile, $str)) {
            return false;
        }

        return true;
    }
}