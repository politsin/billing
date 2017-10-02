<?php

/**
 * @file
 * Contains billing_transaction.page.inc.
 *
 * Page callback for Billing transaction entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Billing transaction templates.
 *
 * Default template: billing_transaction.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_billing_transaction(array &$variables) {
  // Fetch BillingTransaction Entity Object.
  $billing_transaction = $variables['elements']['#billing_transaction'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
