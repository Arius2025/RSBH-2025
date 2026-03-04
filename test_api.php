<?php
$url = "https://feeds.behold.so/SlB320FpXXbkExJMQhJy";
$json = file_get_contents($url);
$data = json_decode($json, true);

if (isset($data['posts'])) {
    foreach ($data['posts'] as $post) {
        echo "ID: " . ($post['id'] ?? 'N/A') . "\n";
        echo "Type: " . ($post['mediaType'] ?? 'N/A') . "\n";
        echo "Media URL: " . ($post['mediaUrl'] ?? 'N/A') . "\n";
        if (isset($post['full'])) {
             echo "Full Media URL: " . ($post['full']['mediaUrl'] ?? 'N/A') . "\n";
        }
        echo "-------------------\n";
    }
} else {
    echo "No posts found.\n";
}
