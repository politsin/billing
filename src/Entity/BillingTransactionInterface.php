<?php

namespace Drupal\billing\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Billing transaction entities.
 *
 * @ingroup billing
 */
interface BillingTransactionInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Billing transaction name.
   *
   * @return string
   *   Name of the Billing transaction.
   */
  public function getName();

  /**
   * Sets the Billing transaction name.
   *
   * @param string $name
   *   The Billing transaction name.
   *
   * @return \Drupal\billing\Entity\BillingTransactionInterface
   *   The called Billing transaction entity.
   */
  public function setName($name);

  /**
   * Gets the Billing transaction creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Billing transaction.
   */
  public function getCreatedTime();

  /**
   * Sets the Billing transaction creation timestamp.
   *
   * @param int $timestamp
   *   The Billing transaction creation timestamp.
   *
   * @return \Drupal\billing\Entity\BillingTransactionInterface
   *   The called Billing transaction entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Billing transaction published status indicator.
   *
   * Unpublished Billing transaction are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Billing transaction is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Billing transaction.
   *
   * @param bool $published
   *   TRUE to set this Billing transaction to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\billing\Entity\BillingTransactionInterface
   *   The called Billing transaction entity.
   */
  public function setPublished($published);

}
