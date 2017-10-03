<?php

namespace Drupal\billing\Controller;

/**
 * @file
 * Contains \Drupal\billing\Controller\BillingTransactionManager.
 */
use Drupal\Core\Controller\ControllerBase;

/**
 * Transaction Manager.
 */
class BillingTransactionManager extends ControllerBase {

  /**
   * Deal.
   */
  public static function deal(array $transaction, string $comment) {

    // Sum check.
    $sum = FALSE;
    if (isset($transaction['sum']) && $transaction['sum'] != 0) {
      $sum = $transaction['sum'];
    }

    // Debit check.
    $debit = FALSE;
    if (isset($transaction['debit_account'])) {
      $debit = $transaction['debit_account'];
    }
    elseif (isset($transaction['account'])) {
      $debit = $transaction['account'];
    }
    // Credit check.
    $credit = FALSE;
    if (isset($transaction['credit_account'])) {
      $credit = $transaction['credit_account'];
    }
    else {
      $credit = BillingAccountManager::getDefaultAccount();
    }

    $entity_type = 'correction';
    $entity_id = 0;
    if (isset($transaction['reason']) && is_object($transaction['reason'])) {
      $reason_entity = $transaction['reason'];
      $entity_type = $reason_entity->bundle();
      $entity_id = $reason_entity->id();
    }

    if ($sum < 0) {
      $sum = -$sum;
      $debit_to_credit = $debit;
      $debit = $credit;
      $credit = $debit_to_credit;
    }

    if ($sum > 0 && $debit && $credit) {
      $transaction_debit = [
        'name' => $comment,
        'account_id' => $debit->id(),
        'debit' => $sum,
        'entity_type' => $entity_type,
        'entity_id' => $entity_id,
      ];

      $transaction_credit = [
        'name' => $comment,
        'account_id' => $credit->id(),
        'credit' => $sum,
        'entity_type' => $entity_type,
        'entity_id' => $entity_id,
      ];
      $hash = '';
      $transaction_debit['hash'] = $hash;
      $transaction_credit['hash'] = $hash;
      self::createTransaction($transaction_debit);
      self::createTransaction($transaction_credit);
      BillingAccountManager::reCalc($debit);
      BillingAccountManager::reCalc($credit);
    }
    return $comment;
  }

  /**
   * Create.
   */
  public static function createTransaction(array $transaction_array) {
    $storage = \Drupal::entityManager()->getStorage('billing_transaction');
    $transaction = $storage->create($transaction_array);
    $transaction->save();
    return $transaction;
  }

}
