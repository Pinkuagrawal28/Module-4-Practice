<?php

namespace Drupal\welcome_di\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a 'Welcome User Role' block.
 *
 * @Block(
 *   id = "welcome_user_role_block_di",
 *   admin_label = @Translation("Welcome User Role Block DI"),
 *   category = @Translation("Custom")
 * )
 */
class WelcomeUserRoleBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * The current user service.
   *
   * @var \Drupal\Core\Session\AccountInterface
   */
  protected AccountInterface $currentUser;

  /**
   * Constructs a new WelcomeUserRoleBlock.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param array $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\Core\Session\AccountInterface $current_user
   *   The current user service.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, AccountInterface $current_user) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->currentUser = $current_user;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('current_user')
    );
  }

  /**
   * Builds the block content.
   *
   * @return array
   *   A render array containing the block content.
   */
  public function build() {
    if ($this->currentUser->isAuthenticated()) {
      $roles = $this->currentUser->getRoles();
      $role_label = ucfirst(str_replace('_', ' ', $roles[1] ?? $roles[0]));
      return [
        '#markup' => $this->t('Welcome @role', ['@role' => $role_label]),
      ];
    }
    return [];
  }
}
