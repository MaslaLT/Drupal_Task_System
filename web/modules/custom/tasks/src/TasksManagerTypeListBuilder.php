<?php

namespace Drupal\tasks;

use Drupal\Core\Config\Entity\ConfigEntityListBuilder;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of tasks manager type entities.
 *
 * @see \Drupal\tasks\Entity\TasksManagerType
 */
class TasksManagerTypeListBuilder extends ConfigEntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['title'] = $this->t('Label');

    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    $row['title'] = [
      'data' => $entity->label(),
      'class' => ['menu-label'],
    ];

    return $row + parent::buildRow($entity);
  }

  /**
   * {@inheritdoc}
   */
  public function render() {
    $build = parent::render();

    $build['table']['#empty'] = $this->t(
      'No tasks manager types available. <a href=":link">Add tasks manager type</a>.',
      [':link' => Url::fromRoute('entity.tasks_manager_type.add_form')->toString()]
    );

    return $build;
  }

}
