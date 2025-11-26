<?php
header('Content-Type: application/json');
require_once 'db.php';

$stmt = $conn->prepare("SELECT * FROM albums");
$stmt->execute();
$result = $stmt->get_result();

// fetch all rows as associative array
$albums = $result->fetch_all(MYSQLI_ASSOC);

$albums = array_map(function($album) {
    return [
        'title' => $album['album_title'],
        'artist' => $album['album_artist'],
        'cover_image' => $album['cover_image'],
        'old_price' => $album['old_price'], 
        'discount_percentage' => $album['discount_percentage']?: 0,
        'stock' => $album['stock_available'],
        'locality' => $album['locality']
    ];
}, $albums);

echo json_encode($albums);
?>
