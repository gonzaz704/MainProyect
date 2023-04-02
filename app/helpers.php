<?php
/**
 * Gets all files of the folder
 *
 * @param [string] $folder
 * @return void
 */
function getAllFiles($folder){
    $files = [];
    $filesInFolder = \File::files($folder); 
    foreach($filesInFolder as $path) { 
          $file = pathinfo($path);
          $files[] = explode('.', $file['filename'])[0];

    }   
    return $files;
}


/**
 * Get user timezone
 *
 * @return string
 */
function get_local_time(){  
    $ip = file_get_contents("http://ipecho.net/plain");
    $url = 'http://ip-api.com/json/'.$ip;
    $tz = file_get_contents($url);
    $tz = json_decode($tz,true)['timezone'];

    return $tz;
}

/**
 * Format date
 *
 * @param [date] $date
 * @return [string]
 */
function format_date($date)
{
    $string_date =  Carbon\Carbon::parse($date)->format('j F Y');
    return $string_date;
}

/**
 * Format image source
 *
 * @param [string] $src
 * @return void
 */
function img_src($src)
{
    return $src;
}
/**
 * build url from parsed url
 *
 * @param array $parts
 * @return void
 */
function build_url(array $parts) {
    return (isset($parts['scheme']) ? "{$parts['scheme']}:" : '') . 
        ((isset($parts['user']) || isset($parts['host'])) ? '//' : '') . 
        (isset($parts['user']) ? "{$parts['user']}" : '') . 
        (isset($parts['pass']) ? ":{$parts['pass']}" : '') . 
        (isset($parts['user']) ? '@' : '') . 
        (isset($parts['host']) ? "{$parts['host']}" : '') . 
        (isset($parts['port']) ? ":{$parts['port']}" : '') . 
        (isset($parts['path']) ? "{$parts['path']}" : '') . 
        (isset($parts['query']) ? "?{$parts['query']}" : '') . 
        (isset($parts['fragment']) ? "#{$parts['fragment']}" : '');
}


