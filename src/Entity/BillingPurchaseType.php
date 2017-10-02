<?php

namespace Drupal\billing\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Billing purchase type entity.
 *
 * @ConfigEntityType(
 *   id = "billing_purchase_type",
 *   label = @Translation("Billing purchase type"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\billing\Entity\BillingPurchaseTypeListBuilder",
 *     "form" = {
 *       "add" = "Drupal\billing\Form\BillingPurchaseTypeForm",
 *       "edit" = "Drupal\billing\Form\BillingPurchaseTypeForm",
 *       "delete" = "Drupal\billing\Form\BillingPurchaseTypeDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\billing\Entity\BillingPurchaseTypeHtmlRouteProvider",
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
