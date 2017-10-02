<?php

namespace Drupal\billing\Controller;

/**
 * @file
 * Contains \Drupal\billing\Controller\BillingAccountManager.
 */
use Drupal\Core\Controller\ControllerBase;

/**
 * Account Manager.
 */
class BillingAccountManager extends ControllerBase {

  /**
   * Get Account by Name.
   */
  public static function getAccount(string $type, int $id = 0) {
    $account = self::query($type, $id = 0);
    if (!$account) {
      $account = self::create($name, $id = 0);
    }

    return $account;
  }

  /**
   * Query.
   */
  public static function query(string $type, int $id = 0) {
    $account = FALSE;
    $query = \Drupal::entityQuery('billing_account')
      ->condition('status', 1)
      ->sort('created', 'ASC')
      ->condition('entity_type', $type)
      ->condition('entity_id', $id)
      ->range(0, 1);
    $ids = $query->execute();
    if (!empty($ids)) {
      $account_id = array_shift($ids);
      $storage = \Drupal::entityManager()->getStorage('billing_account');
      $account = $storage->load($account_id);
    }
    return $account;
  }

  /**
   * Get User Account.
   */
  public static function getUserAccount(int $uid) {
    $billing_account = FALSE;
    if ($uid > 0) {
      $billing_account = self::getAccount('user', $uid);
    }
    return $billing_account;
  }

  /**
   * Get Current User Account.
   */
  public static function getCurrentAccount() {
    $billing_account = FALSE;
    $uid = \Drupal::currentUser()->id();
    if ($uid > 0) {
      $billing_account = self::getUserAccount($uid);
    }
    return $billing_account;
  }

}
