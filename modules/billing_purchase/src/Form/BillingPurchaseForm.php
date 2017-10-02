<?php

namespace Drupal\billing_purchase\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Billing purchase edit forms.
 *
 * @ingroup billing
 */
class BillingPurchaseForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\billing_purchase\Entity\BillingPurchase */
    $form = parent::buildForm($form, $form_state);

    $entity = $this->entity;

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = &$this->entity;

    $status = parent::save($form, $form_state);

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Billing purchase.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Billing purchase.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.billing_purchase.canonical', ['billing_purchase' => $entity->id()]);
  }

}
