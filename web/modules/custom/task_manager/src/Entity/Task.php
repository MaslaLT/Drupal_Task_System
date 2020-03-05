<?php

namespace Drupal\task_manager\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\ContentEntityInterface;

/**
 * Defines the Task entity.
 *
 * @ingroup task_manager
 *
 * @ContentEntityType(
 *   id = "task",
 *   label = @Translation("Tasks list"),
 *   base_table = "task",
 *   entity_keys = {
 *     "id" = "id",
 *     "title" = "title",
 *     "url" = "url",
 *     "assigned_for" = "assigned_for",
 *     "time_given_senior" = "time_given_senior",
 *     "time_given_junior" = "time_given_junior",
 *     "task" = "task",
 *     "owner" = "owner",
 *     "status" = "status",
 *     "time_spent" = "time_spent",
 *   },
 * )
 */
class Task extends ContentEntityBase implements ContentEntityInterface {

}
