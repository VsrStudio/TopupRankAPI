<?php
require 'db.php';

function topupRank($username, $rank, $conn) {
    global $api_url, $api_key;

    $data = [
        'username' => $username,
        'rank' => $rank,
        'api_key' => $api_key,
    ];

    $ch = curl_init($api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    $response = curl_exec($ch);
    curl_close($ch);

    $result = json_decode($response, true);

    $status = $result['success'] ? 'Berhasil' : 'Gagal';
    $stmt = $conn->prepare("INSERT INTO transactions (username, rank, status, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $rank, $status, $result['message']);
    $stmt->execute();

    return $result;
}
?>
