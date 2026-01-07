<?php
    // Récupère les releases depuis GitHub
    $owner = 'AxelShaw0';
    $repo = 'Darts';
    
    $url = "https://api.github.com/repos/{$owner}/{$repo}/releases";
    
    // Utiliser cURL (plus fiable que file_get_contents)
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Darts-App');
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Accept: application/vnd.github.v3+json']);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    curl_close($ch);
    
    if ($response === false || $httpCode !== 200) {
        echo json_encode([
            'success' => false,
            'error' => 'Impossible de récupérer les releases GitHub',
            'debug' => [
                'http_code' => $httpCode,
                'curl_error' => $curlError,
                'url' => $url
            ]
        ]);
        exit;
    }
    
    $releases = json_decode($response, true);
    
    // Si c'est une erreur GitHub
    if (isset($releases['message'])) {
        echo json_encode([
            'success' => false,
            'error' => $releases['message'],
            'debug' => ['github_response' => $releases]
        ]);
        exit;
    }
    
    // Formater les données
    $data = [];
    foreach ($releases as $release) {
        $data[] = [
            'tag' => $release['tag_name'],
            'name' => $release['name'],
            'description' => $release['body'],
            'date' => $release['published_at'],
            'url' => $release['html_url'],
            'prerelease' => $release['prerelease']
        ];
    }
    
    // Version courante = premier tag (le plus récent)
    $currentVersion = count($data) > 0 ? $data[0]['tag'] : 'dev';
    
    echo json_encode([
        'success' => true,
        'current_version' => $currentVersion,
        'releases' => $data
    ]);
?>
