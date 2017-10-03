<?php

namespace Drupal\billing\Controller;

/**
 * @file
 * Contains \Drupal\billing\Controller\PageUserBilling.
 */
use Drupal\Core\Controller\ControllerBase;

/**
 * PageUserBilling.
 */
class PageUserBilling extends ControllerBase {

  /**
   * Page.
   */
  public function page($user = FALSE) {
    $name = $user->name->value;
    $uid = $user->id();
    $billing_account = BillingAccountManager::getUserAccount($uid);
    $amount = (float) $billing_account->get('amount')->value;
    $amount_human = number_format($amount, 3, '.', ' ');
    $result = BillingAccountManager::reCalc($billing_account);
    return [
      'info' => ['#markup' => "Баланс $name: <b>$amount_human</b> фантиков.<br>"],
      'add' => ['#markup' => "<a href='/user/$uid/billing/add-correction'>Добавить фантиков</a>."],
      'form' => \Drupal::formBuilder()->getForm('Drupal\billing\Form\AddCorrection', $uid),
    ];
  }

}
