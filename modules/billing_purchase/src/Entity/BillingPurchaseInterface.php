<?php

namespace Drupal\billing_purchase\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Billing purchase entities.
 *
 * @ingroup billing
 */
interface BillingPurchaseInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Billing purchase name.
   *
   * @return string
   *   Name of the Billing purchase.
   */
  public function getName();

  /**
   * Sets the Billing purchase name.
   *
   * @param string $name
   *   The Billing purchase name.
   *
   * @return \Drupal\billing_purchase\Entity\BillingPurchaseInterface
   *   The called Billing purchase entity.
   */
  public function setName($name);

  /**
   * Gets the Billing purchase creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Billing purchase.
   */
  public function getCreatedTime();

  /**
   * Sets the Billing purchase creation timestamp.
   *
   * @param int $timestamp
   *   The Billing purchase creation timestamp.
   *
   * @return \Drupal\billing_purchase\Entity\BillingPurchaseInterface
   *   The called Billing purchase entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Billing purchase published status indicator.
   *
   * Unpublished Billing purchase are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Billing purchase is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Billing purchase.
   *
   * @param bool $published
   *   TRUE to set this Billing purchase to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\billing_purchase\Entity\BillingPurchaseInterface
   *   The called Billing purchase entity.
   */
  public function setPublished($published);

}
