<?php

namespace Drupal\route_mod\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Session\AccountInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Controller for campaign_mod.
 */
class CampaignController extends ControllerBase {

  protected $currentUser;
  protected $requestStack;

  /**
   * Constructs a CampaignController object.
   *
   * @param \Drupal\Core\Session\AccountInterface $current_user
   *   The current user account.
   * @param \Symfony\Component\HttpFoundation\RequestStack $request_stack
   *   The request stack service.
   */
  public function __construct(AccountInterface $current_user, RequestStack $request_stack) {
    $this->currentUser = $current_user;
    $this->requestStack = $request_stack;
  }

  /**
   * Factory method to create the controller instance.
   *
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   *   The service container.
   *
   * @return static
   *   A new instance of the controller.
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('current_user'),
      $container->get('request_stack')
    );
  }

  /**
   * Returns a render array for the custom page.
   *
   * @return array
   *   A render array containing the page content.
   */
  public function customPage() {
    return [
      '#markup' => $this->t('You have accessed the custom page.'),
    ];
  }

  /**
   * Returns a render array for the campaign value.
   *
   * @param int $number
   *   The number to display in the campaign value.
   *
   * @return array
   *   A render array containing the campaign value.
   */
  public function campaignValue($number) {
    return [
      '#markup' => $this->t('The campaign value is: @number', ['@number' => $number]),
    ];
  }
}
