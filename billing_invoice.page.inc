<?php

/**
 * @file
 * Contains billing_invoice.page.inc.
 *
 * Page callback for Billing invoice entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Billing invoice templates.
 *
 * Default template: billing_invoice.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_billing_invoice(array &$variables) {
  // Fetch BillingInvoice Entity Object.
  $billing_invoice = $variables['elements']['#billing_invoice'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
