<?php

namespace Drupal\drupalup_simple_form\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormState;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\InvokeCommand;

/**
 * Our simple form class.
 */
class AjaxSubmitDemo extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'ajax_form_submit_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['cat_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Cat name'),
      ];


    $form['actions'] = [
      '#type' => 'button',
      '#value' => $this->t('Log cat!'),
      '#ajax' => [
        'callback' => '::logSomething',
      ]
    ];

    $form['#attached']['library'][] = 'drupalup_simple_form/loggy';

    return $form;
  }

  public function logSomething(array &$form, FormStateInterface $form_state) {
    $response = new AjaxResponse();

    $response->addCommand(
      new InvokeCommand(NULL, 'loggy', [$form_state->getValue('cat_name')])
  );

    return $response;

  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

  }

}
