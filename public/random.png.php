<?php
if (getenv("PIXABAY_API_KEY") == NULL) {
    http_response_code(501);
    exit;
}

$is_preview = isset($_REQUEST["preview"]);

$args = "";
if (isset($_REQUEST["transparent"])) {
    $args .= "colors=transparent";
}

$images_search = json_decode(file_get_contents("https://pixabay.com/api/?key=" . getenv("PIXABAY_API_KEY") . "&per_page=3&order=latest" . $args));
$image_url = $is_preview ? $images_search->hits[0]->previewURL : $images_search->hits[0]->webformatURL;

header("Location: " . $image_url);
header("Content-Type: image/png");
?>
