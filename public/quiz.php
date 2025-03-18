<?php
$lang = "fr";
$n = 4;
$words = explode("\n", file_get_contents(__DIR__ . "/liste_francais.txt"));
$words = array_map(fn($w) => trim($w), $words);

if (getenv("PIXABAY_API_KEY") == NULL) {
    http_response_code(501);
    exit;
}

do {
    $propositions = [];
    for ($i = 0; $i < $n; $i++)
        array_push($propositions, $words[random_int(0, count($words) - 1)]);
    $solution = random_int(0, $n - 1);
    $images_search = json_decode(file_get_contents("https://pixabay.com/api/?key=" . getenv("PIXABAY_API_KEY") . "&q=" . $propositions[$solution] . "&image_type=photo&lang=" . $lang));
    if ($images_search == NULL) {
        http_response_code(500);
        exit;
    }
} while ($images_search->totalHits < 4);

$images = array_map(fn($image) => $image->webformatURL, array_slice($images_search->hits, 0, $n));

header("Content-Type: application/json");
echo json_encode([ "propositions" => $propositions, "images" => $images, "solution" => $solution]);
?>
