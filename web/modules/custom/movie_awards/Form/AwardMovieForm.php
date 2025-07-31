<?php

namespace Drupal\movie_awards\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the Award Movie entity.
 *
 * @internal
 */
class AwardMovieForm extends EntityForm {
  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $entity = $this->entity;

    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#default_value' => $entity->label(),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $entity->id(),
      '#machine_name' => [
        'exists' => '\Drupal\movie_awards\Entity\AwardMovie::load',
      ],
      '#disabled' => !$entity->isNew(),
    ];

    $form['year'] = [
      '#type' => 'number',
      '#title' => $this->t('Year'),
      '#default_value' => $entity->get('year') ?: '',
      '#required' => TRUE,
    ];

    $form['movie_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Movie Title'),
      '#default_value' => $entity->get('movie_title') ?: '',
      '#required' => TRUE,
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = $this->entity;
    $entity->set('label', $form_state->getValue('label'));
    $entity->set('year', $form_state->getValue('year'));
    $entity->set('movie_title', $form_state->getValue('movie_title'));
    $status = $entity->save();

    $this->messenger()->addStatus($this->t('Saved %label.', ['%label' => $entity->label()]));
    $form_state->setRedirectUrl($entity->toUrl('collection'));
  }
}
