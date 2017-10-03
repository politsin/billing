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
        'created' => REQUEST_TIME,
        'account_id' => $debit->id(),
        'debit' => $sum,
        'entity_type' => $entity_type,
        'entity_id' => $entity_id,
      ];
      $transaction_credit = [
        'name' => $comment,
        'created' => REQUEST_TIME,
        'account_id' => $credit->id(),
        'credit' => $sum,
        'entity_type' => $entity_type,
        'entity_id' => $entity_id,
      ];
      $hash = self::getHash($transaction_debit, $transaction_credit);
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
  public static function getHash(array $d, array $c) {
    $hash = FALSE;

    $current = "[credit]:{$d['created']}:{$d['debit']}:{$d['account_id']}:{$d['entity_type']}:{$d['entity_id']}";
    $current .= "[debit]:{$c['created']}:{$c['credit']}:{$c['account_id']}:{$c['entity_type']}:{$c['entity_id']}";
    $hash_current = hash('sha256', $current);

    $storage = \Drupal::entityManager()->getStorage('billing_transaction');
    $query = \Drupal::entityQuery('billing_transaction')
      ->condition('status', 1)
      ->sort('id', 'DESC')
      ->range(0, 10);
    $ids = $query->execute();
    $tranactions = [];
    $history = "";
    if (!empty($ids)) {
      foreach ($ids as $id) {
        $entity = $storage->load($id);
        $time = $entity->created->value;
        $d = $entity->debit->value;
        $c = $entity->credit->value;
        $aid = $entity->account_id->entity->id();
        $etype = $entity->entity_type->value;
        $eid = $entity->entity_id->value;
        $h = $entity->hash->value;
        $history .= "[{$id}]:{$time}:{$d}:{$c}:{$aid}:{$etype}:{$eid}:{$h}\n";
      }
    }
    $hash_history = hash('sha256', $history);
    $hash = substr($hash_current, 0, 16) . ":" . substr($hash_history, 0, 16);
    return $hash;
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
