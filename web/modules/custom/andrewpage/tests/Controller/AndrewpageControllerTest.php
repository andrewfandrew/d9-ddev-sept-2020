<?php

namespace Drupal\andrewpage\Tests;

use Drupal\simpletest\WebTestBase;

/**
 * Provides automated tests for the andrewpage module.
 */
class AndrewpageControllerTest extends WebTestBase {


  /**
   * {@inheritdoc}
   */
  public static function getInfo() {
    return [
      'name' => "andrewpage AndrewpageController's controller functionality",
      'description' => 'Test Unit for module andrewpage and controller AndrewpageController.',
      'group' => 'Other',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    parent::setUp();
  }

  /**
   * Tests andrewpage functionality.
   */
  public function testAndrewpageController() {
    // Check that the basic functions of module andrewpage.
    $this->assertEquals(TRUE, TRUE, 'Test Unit Generated via Drupal Console.');
  }

}
