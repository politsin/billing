<?php

namespace Drupal\billing\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Billing amount entities.
 *
 * @ingroup billing
 */
interface BillingAmountInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Billing amount name.
   *
   * @return string
   *   Name of the Billing amount.
   */
  public function getName();

  /**
   * Sets the Billing amount name.
   *
   * @param string $name
   *   The Billing amount name.
   *
   * @return \Drupal\billing\Entity\BillingAmountInterface
   *   The called Billing amount entity.
   */
  public function setName($name);

  /**
   * Gets the Billing amount creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Billing amount.
   */
  public function getCreatedTime();

  /**
   * Sets the Billing amount creation timestamp.
   *
   * @param int $timestamp
   *   The Billing amount creation timestamp.
   *
   * @return \Drupal\billing\Entity\BillingAmountInterface
   *   The called Billing amount entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Billing amount published status indicator.
   *
   * Unpublished Billing amount are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Billing amount is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Billing amount.
   *
   * @param bool $published
   *   TRUE to set this Billing amount to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\billing\Entity\BillingAmountInterface
   *   The called Billing amount entity.
   */
  public function setPublished($published);

}
