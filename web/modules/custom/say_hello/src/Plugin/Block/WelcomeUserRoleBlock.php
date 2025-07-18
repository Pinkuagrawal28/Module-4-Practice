<?php

namespace Drupal\say_hello\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\user\Entity\User;

/**
 * Provides a 'Welcome User Role' Block.
 *
 * @Block(
 *   id = "welcome_user_role_block",
 *   admin_label = @Translation("Welcome User Role Block"),
 *   category = @Translation("Custom")
 * )
 */
class WelcomeUserRoleBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $current_user = \Drupal::currentUser();
    if ($current_user->isAuthenticated()) {
      $roles = $current_user->getRoles();
      $role_label = ucfirst(str_replace('_', ' ', $roles[1] ?? $roles[0]));
      return [
        '#markup' => $this->t('Welcome @role', ['@role' => $role_label]),
      ];
    }
    return [];
  }
}
