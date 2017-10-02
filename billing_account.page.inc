<?php

/**
 * @file
 * Contains billing_account.page.inc.
 *
 * Page callback for Billing account entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Billing account templates.
 *
 * Default template: billing_account.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_billing_account(array &$variables) {
  // Fetch BillingAccount Entity Object.
  $billing_account = $variables['elements']['#billing_account'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
