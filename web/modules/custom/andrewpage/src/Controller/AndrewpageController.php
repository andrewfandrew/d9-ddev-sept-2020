<?php

namespace Drupal\andrewpage\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class AndrewpageController.
 */
class AndrewpageController extends ControllerBase {

  /**
   *   Return a render-able array for a test paged.
   */
  public function content() {
    // Do something with your variables here.
    $myText = 'This is not just a default text!';
    $myNumber = 1;
    $myArray = [1, 2, 3];

    return [
      // Your theme hook name.
      '#theme' => 'andrewpage_theme_hook',
      // Your variables
      '#variable1' => $myText,
      '#variable2' => $myNumber,
      '#variable3' => $myArray,
    ];
  }

}
