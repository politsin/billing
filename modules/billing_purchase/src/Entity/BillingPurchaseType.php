<?php

namespace Drupal\billing_purchase\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Billing purchase type entity.
 *
 * @ConfigEntityType(
 *   id = "billing_purchase_type",
 *   label = @Translation("Billing purchase type"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\billing_purchase\Entity\BillingPurchaseTypeListBuilder",
 *     "form" = {
 *       "add" = "Drupal\billing_purchase\Form\BillingPurchaseTypeForm",
 *       "edit" = "Drupal\billing_purchase\Form\BillingPurchaseTypeForm",
 *       "delete" = "Drupal\billing_purchase\Form\BillingPurchaseTypeDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\billing_purchase\Entity\BillingPurchaseTypeHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "billing_purchase_type",
 *   admin_permission = "administer site configuration",
 *   bundle_of = "billing_purchase",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/billing/billing_purchase_type/{billing_purchase_type}",
 *     "add-form" = "/billing/billing_purchase_type/add",
 *     "edit-form" = "/billing/billing_purchase_type/{billing_purchase_type}/edit",
 *     "delete-form" = "/billing/billing_purchase_type/{billing_purchase_type}/delete",
 *     "collection" = "/billing/billing_purchase_type"
 *   }
 * )
 */
class BillingPurchaseType extends ConfigEntityBundleBase implements BillingPurchaseTypeInterface {

  /**
   * The Billing purchase type ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Billing purchase type label.
   *
   * @var string
   */
  protected $label;

}
