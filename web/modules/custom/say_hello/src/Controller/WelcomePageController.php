<?php

namespace Drupal\say_hello\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Provides a controller for the custom welcome page.
 *
 * @package Drupal\say_hello\Controller
 */
class WelcomePageController extends ControllerBase {

  /**
   * Returns a render array for the custom welcome page.
   *
   * @return array
   *   A render array containing the content of the welcome page.
   */
  public function content() {
    return [
      '#markup' => $this->t('This is the custom welcome page.'),
    ];
  }
}
