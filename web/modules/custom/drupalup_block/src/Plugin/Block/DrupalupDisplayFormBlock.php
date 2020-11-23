<?php

namespace Drupal\drupalup_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;
/**
 * Provides a 'Drupalup Display Form Block' Block.
 * @Block(
 *   id = "drupalup_display_form_block",
 * admin_label = @Translation("Drupalup display form block"),
 *   category = @Translation("Our example Drupal Up display form block"),
 * )
 */
class DrupalupDisplayFormBlock extends BlockBase {

  /**
   * {@inheritDoc}
   */
  public function build() {

    $form = \Drupal::formBuilder()->getForm('Drupal\drupalup_simple_form\Form\SimpleForm');

    return $form;
  }
}







