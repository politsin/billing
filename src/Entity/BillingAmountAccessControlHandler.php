<?php

namespace Drupal\billing\Entity;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Billing amount entity.
 *
 * @see \Drupal\billing\Entity\BillingAmount.
 */
class BillingAmountAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\billing\Entity\BillingAmountInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished billing amount entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published billing amount entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit billing amount entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete billing amount entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add billing amount entities');
  }

}
