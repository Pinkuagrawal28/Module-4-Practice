<?php

namespace Drupal\movie_budget\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class MovieBudgetConfigForm extends ConfigFormBase {

  protected function getEditableConfigNames() {
    return ['movie_budget.settings'];
  }

  public function getFormId() {
    return 'movie_budget_config_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('movie_budget.settings');

    $form['budget_limit'] = [
      '#type' => 'number',
      '#title' => $this->t('Budget-friendly amount'),
      '#description' => $this->t('Set a general budget limit for award-winning movies.'),
      '#default_value' => $config->get('budget_limit') ?? 0,
      '#min' => 0,
      '#required' => TRUE,
    ];

    return parent::buildForm($form, $form_state);
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('award_movies.settings')
      ->set('budget_limit', $form_state->getValue('budget_limit'))
      ->save();

    parent::submitForm($form, $form_state);
  }
}
