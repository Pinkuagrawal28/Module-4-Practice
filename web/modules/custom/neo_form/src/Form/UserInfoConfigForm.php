<?php

namespace Drupal\neo_form\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class UserInfoConfigForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['neo_form.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'neo_form_config_form';
  }

  /**
   * {@inheritdoc}
   * Builds the configuration form for user information.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('neo_form.settings');

    $form['full_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Full Name'),
      '#default_value' => $config->get('full_name'),
      '#required' => TRUE,
    ];

    $form['phone_number'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Phone Number'),
      '#default_value' => $config->get('phone_number'),
      '#required' => TRUE,
    ];

    $form['email'] = [
      '#type' => 'email',
      '#title' => $this->t('Email ID'),
      '#default_value' => $config->get('email'),
      '#required' => TRUE,
    ];

    $form['gender'] = [
      '#type' => 'radios',
      '#title' => $this->t('Gender'),
      '#options' => [
        'male' => $this->t('Male'),
        'female' => $this->t('Female'),
      ],
      '#default_value' => $config->get('gender'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   * Validates the form input.
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $phone = $form_state->getValue('phone_number');
    if (!preg_match('/^[6-9]\d{9}$/', $phone)) {
      $form_state->setErrorByName('phone_number', $this->t('Enter a valid 10-digit Indian mobile number starting with 6-9.'));
    }

    $email = $form_state->getValue('email');
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $form_state->setErrorByName('email', $this->t('Enter a valid email address.'));
    } else {
      $domain = strtolower(substr(strrchr($email, "@"), 1));
      $allowed_domains = ['gmail.com', 'yahoo.com', 'outlook.com', 'hotmail.com'];
      $extension = strtolower(pathinfo($domain, PATHINFO_EXTENSION));

      if (!in_array($domain, $allowed_domains)) {
        $form_state->setErrorByName('email', $this->t('Only public domains like Gmail, Yahoo, Outlook are allowed.'));
      }

      if ($extension !== 'com') {
        $form_state->setErrorByName('email', $this->t('Only .com email addresses are allowed.'));
      }
    }

    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   * Submits the form and saves the configuration.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('neo_form.settings')
      ->set('full_name', $form_state->getValue('full_name'))
      ->set('phone_number', $form_state->getValue('phone_number'))
      ->set('email', $form_state->getValue('email'))
      ->set('gender', $form_state->getValue('gender'))
      ->save();

    parent::submitForm($form, $form_state);
    $this->messenger()->addStatus($this->t('Configuration saved successfully.'));
  }
}
