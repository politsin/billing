<?php

namespace Drupal\billing\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Billing account entities.
 */
class BillingAccountViewsData extends EntityViewsData {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    // Additional information for Views integration, such as table joins, can be
    // put here.

    return $data;
  }

}
