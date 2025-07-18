<?php

namespace Drupal\hello_user\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Provides a controller for displaying a hello message to the user.
 */
class HelloUserController extends ControllerBase {

  /**
   * The Function to get the current user.
   */
  public function hello() {
    $user = $this->currentUser();
    $name = $user->isAuthenticated() ? $user->getDisplayName() : 'Guest';
    return [
      '#markup' => $this->t('Hello @name!', ['@name' => $name]),
    ];
  }
}
