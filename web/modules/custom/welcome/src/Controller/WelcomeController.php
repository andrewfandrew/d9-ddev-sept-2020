<?php

namespace Drupal\welcome\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class WelcomeController.
 */
class WelcomeController extends ControllerBase {

  /**
   * Welcome.
   *
   * @return string
   *   Return Hello string.
   */
  public function welcome() {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Implement method: welcome')
    ];
  }

}
