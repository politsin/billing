<?php

namespace Drupal\billing\Controller;

/**
 * @file
 * Contains \Drupal\billing\Controller\PageUserBilling.
 */
use Drupal\Core\Controller\ControllerBase;

/**
 * PageUserBilling.
 */
class PageUserBilling extends ControllerBase {

  /**
   * Page.
   */
  public function page($user = FALSE) {
    return [
      '#markup' => '<p>' . $this->t('Hello world.') . '</p>',
    ];
  }

}
