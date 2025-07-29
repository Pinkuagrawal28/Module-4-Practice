<?php

namespace Drupal\welcome_di\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Session\AccountInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Controller for the custom welcome page.
 */
class WelcomePageController extends ControllerBase {

  protected $currentUser;

  /**
   * Constructs a new WelcomePageController.
   *
   * @param \Drupal\Core\Session\AccountInterface $current_user
   *   The current user service.
   */
  public function __construct(AccountInterface $current_user) {
    $this->currentUser = $current_user;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('current_user')
    );
  }

  /**
   * Returns the content for the custom welcome page.
   */
  public function content() {
    $name = $this->currentUser->getDisplayName();
    return [
      '#markup' => $this->t('This is the custom welcome page for @name.', ['@name' => $name]),
    ];
  }
}
