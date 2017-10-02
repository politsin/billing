<?php

namespace Drupal\billing\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class BillingInvoiceTypeForm.
 */
class BillingInvoiceTypeForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $billing_invoice_type = $this->entity;
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $billing_invoice_type->label(),
      '#description' => $this->t("Label for the Billing invoice type."),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $billing_invoice_type->id(),
      '#machine_name' => [
        'exists' => '\Drupal\billing\Entity\BillingInvoiceType::load',
      ],
      '#disabled' => !$billing_invoice_type->isNew(),
    ];

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $billing_invoice_type = $this->entity;
    $status = $billing_invoice_type->save();

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Billing invoice type.', [
          '%label' => $billing_invoice_type->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Billing invoice type.', [
          '%label' => $billing_invoice_type->label(),
        ]));
    }
    $form_state->setRedirectUrl($billing_invoice_type->toUrl('collection'));
  }

}
