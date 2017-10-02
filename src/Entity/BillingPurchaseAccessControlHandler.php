<?php

namespace Drupal\billing\Entity;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Billing purchase entity.
 *
 * @see \Drupal\billing\Entity\BillingPurchase.
 */
class BillingPurchaseAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\billing\Entity\BillingPurchaseInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished billing purchase entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published billing purchase entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit billing purchase entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete billing purchase entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add billing purchase entities');
  }

}
