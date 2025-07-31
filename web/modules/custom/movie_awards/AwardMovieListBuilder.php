<?php

namespace Drupal\movie_awards;

use Drupal\Core\Config\Entity\ConfigEntityListBuilder;
use Drupal\Core\Entity\EntityInterface;

/**
 * Provides a listing of Award Movie entities.
 *
 * @internal
 */
class AwardMovieListBuilder extends ConfigEntityListBuilder {
  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['label'] = $this->t('Label');
    $header['year'] = $this->t('Year');
    $header['movie_title'] = $this->t('Movie Title');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    $row['label'] = $entity->label();
    $row['year'] = $entity->get('year');
    $row['movie_title'] = $entity->get('movie_title');
    return $row + parent::buildRow($entity);
  }
}
