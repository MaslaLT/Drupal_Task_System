<?php


namespace Drupal\task_creation_form\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class TaskCreationController
 *
 * @package Drupal\task_creation_form\Controller
 */
class TaskController extends ControllerBase {
  public function showTasks() {
    return [
      '#type' => 'markup',
      '#markup' => t('This is my menu linked custom page'),
    ];
  }
}
