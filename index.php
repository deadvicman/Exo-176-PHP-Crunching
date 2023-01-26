<?php
$file = 'dictionnaire.txt';
$contents = file_get_contents($file);
$words = str_word_count($contents);
echo "Le fichier contient $words mots." . "<br>";

$words = preg_split('/\s+/', $contents);
// Utiliser array_filter() pour filtrer les mots qui ont 15 caractères
$test = array_filter($words, function($word) {
    return strlen($word) === 15;
});

$count = count($test);
echo "Le fichier contient $count mots de 15 caractères.". "<br>";

$endWithQ = array_filter($words, function($word) {
    return substr($word, -1) === 'q'. "<br>";
});

$endWithW = array_filter($words, function($word) {
    return substr($word, -1) === 'w'. "<br>";
});
$count = count($endWithQ);
$count2 = count($endWithW);
echo "Le fichier contient $count mots qui finissent par la lettre q." . "<br>";

echo "Le fichier contient $count2 mots qui finissent par la lettre w.". "<br>" . "<br>";


$string = file_get_contents("films.json", FILE_USE_INCLUDE_PATH);
$brut = json_decode($string, true);
$top = $brut["feed"]["entry"]; # liste de films

for ($i = 0; $i < 10; $i++) {
    echo ($i + 1) . '. ' . $top[$i]['im:name']['label'] . "<br>";
}

$film = "Gravity";
foreach ($top as $key => $value) {
    if (strcmp($value['im:name']['label'], $film) == 0) {
        echo "Le classement de '$film' est : " . ($key + 1) . "\n";
        break;
    }
}
$film = "The LEGO Movie";
foreach ($top as $value) {
    if (strcmp($value['im:name']['label'], $film) == 0) {
        echo "Le réalisateur de '$film' est : " . $value['im:artist']['label'] . "\n";
        break;
    }
}

$count = 0;
foreach ($top as $value) {
    $year = date("Y", strtotime($value['im:releaseDate']['attributes']['label']));
    if ($year < 2000) {
        $count++;
    }
}

echo "Il y a $count films sortis avant 2000.\n";