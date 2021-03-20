<?php
header("Location: ".json_decode(file_get_contents("https://pixabay.com/api/?key=15601609-0000000000000000000000000&per_page=3&colors=transparent&order=latest"))->hits[0]->previewURL);
header("Content-Type: image/png");
?>
