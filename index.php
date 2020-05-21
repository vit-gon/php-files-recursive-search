<?php

require_once(__DIR__ . '/src/CountController.php');

CONST FILE_REGEX = '/^count\.txt$/i';
CONST SEARCH_FOLDER = __DIR__ . '/test-folder';

$count_controller = new CountController();

$files = $count_controller->findFiles(SEARCH_FOLDER, FILE_REGEX);
$numbers_arr = $count_controller->getFilesContentAsArray($files);

// The number can be of any type, that's why use %f.
// The only decimal is in /test-folder/count.txt (2.1),
// other files has (2)
printf("[count.txt] | Sum: %f", array_sum($numbers_arr));