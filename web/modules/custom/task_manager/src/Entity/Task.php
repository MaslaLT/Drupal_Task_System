<?php

namespace Drupal\task_manager\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;

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
 *     "time_needs_senior" = "time_needs_senior",
 *     "time_needs_junior" = "time_needs_junior",
 *     "task" = "task",
 *     "created_by" = "created_by",
 *     "status" = "status",
 *     "time_spent" = "time_spent",
 *     "created" = "created",
 *   },
 *   handlers = {
 *     "views_data" = "Drupal\task_manager\TaskViewsData",
 *   },
 * )
 */
class Task extends ContentEntityBase implements ContentEntityInterface {

  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {

    // Standard field, used as unique if primary index.
    $fields['id'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('Id'))
      ->setDescription(t('The ID of the Task entity.'))
      ->setReadOnly(TRUE);

    $fields['title'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Title'))
      ->setDescription(t('The task title.'))
      ->setSettings([
        'max_length' => 255,
        'text_processing' => 0,
      ]);

    $fields['url'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Url'))
      ->setDescription(t('The external url for task.'))
      ->setSettings([
        'max_length' => 255,
        'text_processing' => 0,
      ])
      ->setDefaultValue(NULL);

    // This task is assigned for.
    $fields['assigned_for'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('Assigned for user'))
      ->setDescription(t('The ID of user this task is assigned for.'));

    // Time given for senior to complete this task. In hours.
    $fields['time_needs_senior'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('Time needs senior'))
      ->setDescription(t('Time needed for senior to complete this task. In hours.'));

    // Time given for junior to complete this task. In hours.
    $fields['time_needs_junior'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('Time needs junior'))
      ->setDescription(t('Time needed for junior to complete this task. In hours.'));

    $fields['task'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Url'))
      ->setDescription(t('The external url for task.'))
      ->setSettings([
        'max_length' => 8000,
        'text_processing' => 0,
      ])
      ->setDefaultValue(NULL);

    // ID of user who created this task.
    $fields['created_by'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('Created by'))
      ->setDescription(t('ID of user who created this task'));

    $fields['status'] = BaseFieldDefinition::create('string')
      ->setLabel(t('STATUS'))
      ->setDescription(t('Current task status.'))
      ->setSettings([
        'max_length' => 255,
        'text_processing' => 0,
      ]);

    // Time given for junior to complete this task. In hours.
    $fields['time_spent'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('Time spent'))
      ->setDescription(t('Time needed for junior to complete this task. In hours.'));

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The Node Id of the Advertiser entity.'))
      ->setReadOnly(TRUE);

    return $fields;
  }
}
