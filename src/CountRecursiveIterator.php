<?php

class CountRecursiveIterator extends \RecursiveRegexIterator
{
  private $regex;

  public function __construct(RecursiveIterator $it, $regex)
  {
      $this->regex = $regex;
      parent::__construct($it, $regex);
  }

  public function accept()
  {
    return ( !$this->isFile() || preg_match($this->regex, $this->getFilename()));
  }
}