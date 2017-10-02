<?php

/**
 * @file
 * Contains billing_purchase.page.inc.
 *
 * Page callback for Billing purchase entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Billing purchase templates.
 *
 * Default template: billing_purchase.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_billing_purchase(array &$variables) {
  // Fetch BillingPurchase Entity Object.
  $billing_purchase = $variables['elements']['#billing_purchase'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
