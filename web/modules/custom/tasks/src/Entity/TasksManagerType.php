<?php

namespace Drupal\tasks\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Tasks Manager type configuration entity.
 *
 * @ConfigEntityType(
 *   id = "tasks_manager_type",
 *   label = @Translation("Tasks Manager type"),
 *   handlers = {
 *     "form" = {
 *       "add" = "Drupal\tasks\Form\TasksManagerTypeForm",
 *       "edit" = "Drupal\tasks\Form\TasksManagerTypeForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm",
 *     },
 *     "list_builder" = "Drupal\tasks\TasksManagerTypeListBuilder",
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     }
 *   },
 *   admin_permission = "administer tasks manager types",
 *   bundle_of = "tasks_manager",
 *   config_prefix = "tasks_manager_type",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "add-form" = "/admin/structure/tasks_manager_types/add",
 *     "edit-form" = "/admin/structure/tasks_manager_types/manage/{tasks_manager_type}",
 *     "delete-form" = "/admin/structure/tasks_manager_types/manage/{tasks_manager_type}/delete",
 *     "collection" = "/admin/structure/tasks_manager_types"
 *   },
 *   config_export = {
 *     "id",
 *     "label",
 *     "uuid",
 *   }
 * )
 */
class TasksManagerType extends ConfigEntityBundleBase {

  /**
   * The machine name of this tasks manager type.
   *
   * @var string
   */
  protected $id;

  /**
   * The human-readable name of the tasks manager type.
   *
   * @var string
   */
  protected $label;

}
