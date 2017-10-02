<?php

namespace Drupal\billing_invoice\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Billing invoice edit forms.
 *
 * @ingroup billing
 */
class BillingInvoiceForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\billing_invoice\Entity\BillingInvoice */
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
        drupal_set_message($this->t('Created the %label Billing invoice.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Billing invoice.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.billing_invoice.canonical', ['billing_invoice' => $entity->id()]);
  }

}
