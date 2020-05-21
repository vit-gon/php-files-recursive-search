<?php

require_once(__DIR__ . './CountRecursiveIterator.php');


class CountController
{

  /**
   * @param string $searchFolder
   * @param string $filenameRegex
   * 
   * @return SplFileInfo[] $spl_files_arr
   */
  public function findFiles(string $searchFolder, string $filenameRegex): array
  {
    $directory = new RecursiveDirectoryIterator($searchFolder);
    $filter = new CountRecursiveIterator($directory, $filenameRegex);
    $spl_files_arr = [];

    foreach (new RecursiveIteratorIterator($filter) as $spl_file_info)
    {
      if (!preg_match('/^(\.)+$/i', $spl_file_info->getFilename()))
      {
        $spl_files_arr[] = $spl_file_info;
      }
    }

    return $spl_files_arr;
  }

  /**
   * Accepts an array of type SplFileInfo
   * and returns content of each file in array
   * 
   * @param SplFileInfo[] $splFilesArr
   * 
   * @return int[] $files_content_arr
   */
  public function getFilesContentAsArray(array $splFilesArr): array
  {
    $files_content_arr = [];
    foreach ($splFilesArr as $splFile)
    {
      
      $fh = fopen($splFile->getPathName(),'r');
      while ($line = fgets($fh)) {
        $number = filter_var(trim($line), FILTER_VALIDATE_FLOAT);
        if ($number)
        {
          $files_content_arr[] = $number;
        }
      }
      fclose($fh);
    }
    return $files_content_arr;
  }
}