<?php

/**
 * @file
 * Contains statistic.page.inc.
 *
 * Page callback for Statistic entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Statistic templates.
 *
 * Default template: statistic.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_statistic(array &$variables) {
  // Fetch Statistic Entity Object.
  $statistic = $variables['elements']['#statistic'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
