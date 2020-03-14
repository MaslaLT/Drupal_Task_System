<?php

namespace Drupal\tasks;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Defines the access control handler for the tasks manager entity type.
 */
class TasksManagerAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {

    switch ($operation) {
      case 'view':
        return AccessResult::allowedIfHasPermission($account, 'view tasks manager');

      case 'update':
        return AccessResult::allowedIfHasPermissions($account, ['edit tasks manager', 'administer tasks manager'], 'OR');

      case 'delete':
        return AccessResult::allowedIfHasPermissions($account, ['delete tasks manager', 'administer tasks manager'], 'OR');

      default:
        // No opinion.
        return AccessResult::neutral();
    }

  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermissions($account, ['create tasks manager', 'administer tasks manager'], 'OR');
  }

}
