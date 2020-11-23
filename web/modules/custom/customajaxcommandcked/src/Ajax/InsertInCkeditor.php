<?php
/**
 * InsertInCkeditor.php contains InsertInCkeditor class
 * Defines custom ajax command to set the value in CKeditor using Ajax
 */
namespace Drupal\customajaxcommandcked\Ajax;
use Drupal\Core\Ajax\CommandInterface;
use Drupal\Core\Asset\AttachedAssets;

class InsertInCkeditor implements CommandInterface {
  /**
   * A CSS selector string.
   *
   * If the command is a response to a request from an #ajax form element then
   * this value can be NULL.
   *
   * @var string
   */
  protected $selector;

  /**
   * A jQuery method to invoke.
   *
   * @var string
   */
  protected $method;

  /**
   * Constructs an InvokeCommand object.
   *
   * @param string $selector
   * A jQuery selector.
   * @param string $method
   * The name of a jQuery method to invoke.
   * @param array $arguments
   * An optional array of arguments to pass to the method.
   */
  public function __construct($selector, $method, array $arguments = []) {
    $this->selector;
    $this->method;
    $this->arguments = $arguments;
  }

  public function render() {
    return [
      'command' => 'InsertInCkEditor',
      'selector' => $this->selector,
      'args' => $this->arguments,
    ];
  }
}
