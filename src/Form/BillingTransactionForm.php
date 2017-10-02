<?php

namespace Drupal\billing\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Billing transaction edit forms.
 *
 * @ingroup billing
 */
class BillingTransactionForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\billing\Entity\BillingTransaction */
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
        drupal_set_message($this->t('Created the %label Billing transaction.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Billing transaction.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.billing_transaction.canonical', ['billing_transaction' => $entity->id()]);
  }

}
