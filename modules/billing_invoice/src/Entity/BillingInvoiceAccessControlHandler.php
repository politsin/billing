<?php

namespace Drupal\billing_invoice\Entity;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Billing invoice entity.
 *
 * @see \Drupal\billing_invoice\Entity\BillingInvoice.
 */
class BillingInvoiceAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\billing_invoice\Entity\BillingInvoiceInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished billing invoice entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published billing invoice entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit billing invoice entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete billing invoice entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add billing invoice entities');
  }

}
