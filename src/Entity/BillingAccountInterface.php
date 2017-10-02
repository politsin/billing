<?php

namespace Drupal\billing\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Billing account entities.
 *
 * @ingroup billing
 */
interface BillingAccountInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Billing account name.
   *
   * @return string
   *   Name of the Billing account.
   */
  public function getName();

  /**
   * Sets the Billing account name.
   *
   * @param string $name
   *   The Billing account name.
   *
   * @return \Drupal\billing\Entity\BillingAccountInterface
   *   The called Billing account entity.
   */
  public function setName($name);

  /**
   * Gets the Billing account creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Billing account.
   */
  public function getCreatedTime();

  /**
   * Sets the Billing account creation timestamp.
   *
   * @param int $timestamp
   *   The Billing account creation timestamp.
   *
   * @return \Drupal\billing\Entity\BillingAccountInterface
   *   The called Billing account entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Billing account published status indicator.
   *
   * Unpublished Billing account are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Billing account is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Billing account.
   *
   * @param bool $published
   *   TRUE to set this Billing account to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\billing\Entity\BillingAccountInterface
   *   The called Billing account entity.
   */
  public function setPublished($published);

}
