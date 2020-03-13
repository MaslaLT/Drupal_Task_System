<?php

namespace Drupal\task_manager;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\user\EntityOwnerInterface;
use Drupal\Core\Entity\EntityChangedInterface;

/**
 * Provides an interface defining a task_manager entity type.
 */
interface TaskManagerInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

  /**
   * Gets the task_manager title.
   *
   * @return string
   *   Title of the task_manager.
   */
  public function getTitle();

  /**
   * Sets the task_manager title.
   *
   * @param string $title
   *   The task_manager title.
   *
   * @return \Drupal\task_manager\TaskManagerInterface
   *   The called task_manager entity.
   */
  public function setTitle($title);

  /**
   * Gets the task_manager creation timestamp.
   *
   * @return int
   *   Creation timestamp of the task_manager.
   */
  public function getCreatedTime();

  /**
   * Sets the task_manager creation timestamp.
   *
   * @param int $timestamp
   *   The task_manager creation timestamp.
   *
   * @return \Drupal\task_manager\TaskManagerInterface
   *   The called task_manager entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the task_manager status.
   *
   * @return bool
   *   TRUE if the task_manager is enabled, FALSE otherwise.
   */
  public function isEnabled();

  /**
   * Sets the task_manager status.
   *
   * @param bool $status
   *   TRUE to enable this task_manager, FALSE to disable.
   *
   * @return \Drupal\task_manager\TaskManagerInterface
   *   The called task_manager entity.
   */
  public function setStatus($status);

}
