<?php

/**
 * @file
 * Contains billing_amount.page.inc.
 *
 * Page callback for Billing amount entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Billing amount templates.
 *
 * Default template: billing_amount.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_billing_amount(array &$variables) {
  // Fetch BillingAmount Entity Object.
  $billing_amount = $variables['elements']['#billing_amount'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
