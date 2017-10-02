<?php

namespace Drupal\billing_invoice\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Billing invoice entities.
 *
 * @ingroup billing
 */
interface BillingInvoiceInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Billing invoice name.
   *
   * @return string
   *   Name of the Billing invoice.
   */
  public function getName();

  /**
   * Sets the Billing invoice name.
   *
   * @param string $name
   *   The Billing invoice name.
   *
   * @return \Drupal\billing_invoice\Entity\BillingInvoiceInterface
   *   The called Billing invoice entity.
   */
  public function setName($name);

  /**
   * Gets the Billing invoice creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Billing invoice.
   */
  public function getCreatedTime();

  /**
   * Sets the Billing invoice creation timestamp.
   *
   * @param int $timestamp
   *   The Billing invoice creation timestamp.
   *
   * @return \Drupal\billing_invoice\Entity\BillingInvoiceInterface
   *   The called Billing invoice entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Billing invoice published status indicator.
   *
   * Unpublished Billing invoice are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Billing invoice is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Billing invoice.
   *
   * @param bool $published
   *   TRUE to set this Billing invoice to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\billing_invoice\Entity\BillingInvoiceInterface
   *   The called Billing invoice entity.
   */
  public function setPublished($published);

}
