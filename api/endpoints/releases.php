<?php
    $owner = 'AxelShaw';
    $repo = 'Darts';
    
    $ch = curl_init("https://api.github.com/repos/{$owner}/{$repo}/releases");
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_USERAGENT => 'Darts-App',
        CURLOPT_TIMEOUT => 10
    ]);
    
    $response = curl_exec($ch);
    $ok = curl_getinfo($ch, CURLINFO_HTTP_CODE) === 200;
    curl_close($ch);
    
    if (!$ok) {
        echo json_encode(['success' => false, 'error' => 'GitHub API error']);
        exit;
    }
    
    $releases = array_map(fn($r) => [
        'tag' => $r['tag_name'],
        'name' => $r['name'],
        'description' => $r['body'],
        'date' => $r['published_at'],
        'url' => $r['html_url'],
        'prerelease' => $r['prerelease']
    ], json_decode($response, true));
    
    echo json_encode([
        'success' => true,
        'current_version' => $releases[0]['tag'] ?? 'dev',
        'releases' => $releases
    ]);
?>
