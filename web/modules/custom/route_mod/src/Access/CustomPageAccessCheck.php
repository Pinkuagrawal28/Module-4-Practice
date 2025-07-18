<?php

namespace Drupal\route_mod\Access;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Session\AccountInterface;

/**
 * Provides a custom access check for a specific page.
 */
class CustomPageAccessCheck {

  /**
   * Custom access callback.
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The user account to check access for.
   * @return \Drupal\Core\Access\AccessResult
   *   The access result.
   */
  public function access(AccountInterface $account) {
    // Custom logic: must be admin and must have permission
    $allowed_roles = ['administrator'];
    $has_permission = $account->hasPermission('access the custom page');

    if (array_intersect($allowed_roles, $account->getRoles()) && $has_permission) {
      return AccessResult::allowed();
    }

    return AccessResult::forbidden();
  }
}
