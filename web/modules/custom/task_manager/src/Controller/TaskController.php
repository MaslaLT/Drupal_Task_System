<?php


namespace Drupal\task_creation_form\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class TaskCreationController
 *
 * @package Drupal\task_creation_form\Controller
 */
class TaskCreationController extends ControllerBase {
  public function content() {
    return [
      '#type' => 'markup',
      '#markup' => t('This is my menu linked custom page'),
    ];
  }
}
