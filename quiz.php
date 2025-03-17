<?php
define("PIXABAY_API_KEY", "15601609-0000000000000000000000000");

$lang = "fr";
$n = 4;
$words = explode("\n", file_get_contents("liste_francais.txt"));
$words = array_map(fn($w) => trim($w), $words);

do {
    $propositions = [];
    for ($i = 0; $i < $n; $i++)
        array_push($propositions, $words[random_int(0, count($words) - 1)]);
    $solution = random_int(0, $n - 1);
    $images_search = json_decode(file_get_contents("https://pixabay.com/api/?key=".PIXABAY_API_KEY."&q=".$propositions[$solution]."&image_type=photo&lang=".$lang));
} while ($images_search->totalHits < 4);

$images = array_map(fn($image) => $image->webformatURL, array_slice($images_search->hits, 0, $n));

echo json_encode([ "propositions" => $propositions, "images" => $images, "solution" => $solution]);
?>
