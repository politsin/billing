<?php

namespace Drupal\billing\Form;

/**
 * @file
 * Contains Drupal\synbilling\Form\AddToCart.
 */

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\billing\Controller\BillingTransactionManager;
use Drupal\billing\Controller\BillingAccountManager;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;

/**
 * AddToCart.
 */
class AddCorrection extends FormBase {

  /**
   * F: billingAdd.
   */
  public function billingAdd(array &$form, FormStateInterface $form_state) {
    $sum = $form_state->getValue("sum");
    $uid = $form_state->uid;
    $output = "\n\nbillingAdd:\n";

    if (is_numeric($sum) && is_numeric($uid)) {
      $author = \Drupal::currentUser()->id();
      $comment = "user-$uid correction by uid-$author";
      $transaction = [
        'sum' => floatval($sum),
        'account' => BillingAccountManager::getUserAccount($uid),
      ];
      $deal = BillingTransactionManager::deal($transaction, $comment);
      $output .= "$deal\n";
      $sum_human = number_format($sum, 6);
      $output .= "Фантики добавлены для user-$uid: $sum_human $";
    }

    $response = new AjaxResponse();
    $response->addCommand(new HtmlCommand("#billing", "<pre>$output</pre>"));
    return $response;
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'billing_add';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, $extra = NULL) {
    $form_state->setCached(FALSE);
    $form_state->uid = $extra;
    if (is_numeric($form_state->uid)) {
      $form["#suffix"] = "<div class='billing-result' id='billing'></div>";
      $form["sum"] = [
        '#type' => 'number',
        '#title' => 'Сумма фантиков',
        '#min' => -999999.999999,
        '#max' => 999999.999999,
        '#step' => 0.000001,
      ];
      $form["billing-submit"] = [
        '#type' => 'submit',
        '#value' => 'Добавить фантиков',
        '#attributes' => ['class' => ['btn', 'btn-xs', 'btn-primary']],
        '#ajax'   => [
          'callback' => '::billingAdd',
          'effect'   => 'fade',
          'progress' => ['type' => 'throbber', 'message' => "Добавляем"],
        ],
      ];
    }
    return $form;
  }

  /**
   * Implements a form submit handler.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $form_state->setRebuild(TRUE);
  }

}
