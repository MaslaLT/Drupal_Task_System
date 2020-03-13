<?php

namespace Drupal\tasks;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\user\EntityOwnerInterface;
use Drupal\Core\Entity\EntityChangedInterface;

/**
 * Provides an interface defining a tasks manager entity type.
 */
interface TasksManagerInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

  /**
   * Gets the tasks manager title.
   *
   * @return string
   *   Title of the tasks manager.
   */
  public function getTitle();

  /**
   * Sets the tasks manager title.
   *
   * @param string $title
   *   The tasks manager title.
   *
   * @return \Drupal\tasks\TasksManagerInterface
   *   The called tasks manager entity.
   */
  public function setTitle($title);

  /**
   * Gets the tasks manager creation timestamp.
   *
   * @return int
   *   Creation timestamp of the tasks manager.
   */
  public function getCreatedTime();

  /**
   * Sets the tasks manager creation timestamp.
   *
   * @param int $timestamp
   *   The tasks manager creation timestamp.
   *
   * @return \Drupal\tasks\TasksManagerInterface
   *   The called tasks manager entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the tasks manager status.
   *
   * @return bool
   *   TRUE if the tasks manager is enabled, FALSE otherwise.
   */
  public function isEnabled();

  /**
   * Sets the tasks manager status.
   *
   * @param bool $status
   *   TRUE to enable this tasks manager, FALSE to disable.
   *
   * @return \Drupal\tasks\TasksManagerInterface
   *   The called tasks manager entity.
   */
  public function setStatus($status);

}
