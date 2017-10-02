<?php

namespace Drupal\billing_invoice\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Billing invoice type entity.
 *
 * @ConfigEntityType(
 *   id = "billing_invoice_type",
 *   label = @Translation("Billing invoice type"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\billing_invoice\Entity\BillingInvoiceTypeListBuilder",
 *     "form" = {
 *       "add" = "Drupal\billing_invoice\Form\BillingInvoiceTypeForm",
 *       "edit" = "Drupal\billing_invoice\Form\BillingInvoiceTypeForm",
 *       "delete" = "Drupal\billing_invoice\Form\BillingInvoiceTypeDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\billing_invoice\Entity\BillingInvoiceTypeHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "billing_invoice_type",
 *   admin_permission = "administer site configuration",
 *   bundle_of = "billing_invoice",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/billing/billing_invoice_type/{billing_invoice_type}",
 *     "add-form" = "/billing/billing_invoice_type/add",
 *     "edit-form" = "/billing/billing_invoice_type/{billing_invoice_type}/edit",
 *     "delete-form" = "/billing/billing_invoice_type/{billing_invoice_type}/delete",
 *     "collection" = "/billing/billing_invoice_type"
 *   }
 * )
 */
class BillingInvoiceType extends ConfigEntityBundleBase implements BillingInvoiceTypeInterface {

  /**
   * The Billing invoice type ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Billing invoice type label.
   *
   * @var string
   */
  protected $label;

}
