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
  public static function getDefaultAccount() {
    $type = 'system';
    $id = 0;
    $account = self::query($type, $id);
    if (!$account) {
      $account = self::createAccount($type, $id);
    }
    return $account;
  }

  /**
   * Get Account by Name.
   */
  public static function getAccount(string $type, int $id = 0) {
    $account = self::query($type, $id);
    if (!$account) {
      $account = self::createAccount($type, $id);
    }
    return $account;
  }

  /**
   * Get Create.
   */
  public static function createAccount(string $type, int $id = 0) {
    $storage = \Drupal::entityManager()->getStorage('billing_account');
    $account = $storage->create([
      'name' => "$type - $id",
      'entity_type' => $type,
      'entity_id' => $id,
    ]);
    $account->save();
    return $account;
  }

  /**
   * Get Create.
   */
  public static function reCalc($account) {
    $transactions = self::reCalcQuery($account->id());
    $amount = 0;
    if ($transactions) {
      foreach ($transactions as $key => $value) {
        $amount = $amount + (float) $value->debit - (float) $value->credit;
      }
    }
    $account->amount->setValue($amount);
    $account->save();
    return $amount;
  }

  /**
   * Get Create.
   */
  public static function reCalcQuery($account_id) {
    $fields = [
      'entity_id',
      'debit',
      'credit',
    ];
    $query = \Drupal::database()->select('billing_transaction', 'transactions');
    $query->fields('transactions', $fields);
    $query->condition('status', 1);
    $query->condition('account_id', $account_id);
    $result = $query->execute();
    return $result;
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
