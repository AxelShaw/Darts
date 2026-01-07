<?php
    // Récupère les releases depuis GitHub
    $owner = 'AxelShaw0';
    $repo = 'Darts';
    
    $url = "https://api.github.com/repos/{$owner}/{$repo}/releases";
    
    $options = [
        'http' => [
            'method' => 'GET',
            'header' => [
                'User-Agent: Darts-App',
                'Accept: application/vnd.github.v3+json'
            ]
        ]
    ];
    
    $context = stream_context_create($options);
    $response = @file_get_contents($url, false, $context);
    
    if ($response === false) {
        echo json_encode([
            'success' => false,
            'error' => 'Impossible de récupérer les releases GitHub'
        ]);
        exit;
    }
    
    $releases = json_decode($response, true);
    
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

