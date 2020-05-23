<?php


namespace App\Entity;


class RdForm
{
  protected $language;

  public function getLanguage()
  {
      return $this->language;
  }
  public function setLanguage($language)
  {
      $this->language = $language;
  }
}