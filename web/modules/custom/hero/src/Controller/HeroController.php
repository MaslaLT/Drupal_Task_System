<?php

namespace Drupal\hero\Controller;

class HeroController {

  public function heroList() {
    $heroes = [
      ['name' => 'Hulk'],
      ['name' => 'Thor'],
      ['name' => 'Spider Man'],
      ['name' => 'Iron Man'],
      ['name' => 'Black Widow'],
    ];

    $ourHeroes = '';
    dump($heroes);
    return [];
  }
}
