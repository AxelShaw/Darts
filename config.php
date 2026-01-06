<?php
    // DB
    define('DB_HOST', getenv('MYSQL_HOST'));
    define('DB_PORT', getenv('MYSQL_PORT'));
    define('DB_NAME', getenv('MYSQL_DATABASE'));
    define('DB_USER', getenv('MYSQL_USER'));
    define('DB_PASS', getenv('MYSQL_PASSWORD'));

    // App
    define('APP_NAME', 'Darts App');
    
    // Version
    define('GITHUB_REPO', 'AxelShaw/Darts');
    
    function getAppVersion() {
        $cacheFile = sys_get_temp_dir() . '/darts_version.txt';
        
        // Cache de 5 minutes pour éviter trop d'appels API
        if (file_exists($cacheFile) && (time() - filemtime($cacheFile)) < 300) {
            return trim(file_get_contents($cacheFile));
        }
        
        $url = 'https://api.github.com/repos/' . GITHUB_REPO . '/tags';
        $opts = ['http' => ['header' => 'User-Agent: DartsApp']];
        $json = @file_get_contents($url, false, stream_context_create($opts));
        
        if ($json) {
            $tags = json_decode($json, true);
            if (!empty($tags[0]['name'])) {
                $version = $tags[0]['name'];
                file_put_contents($cacheFile, $version);
                return $version;
            }
        }
        return '0.0.0';
    }
    
    define('APP_VERSION', getAppVersion());
?>

