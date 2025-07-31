<?php

namespace Drupal\movie_awards\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;

/**
 * Defines the Award Movie configuration entity.
 *
 * @ConfigEntityType(
 *   id = "movie_award",
 *   label = @Translation("Award-winning movie"),
 *   handlers = {
 *     "list_builder" = "Drupal\movie_awards\AwardMovieListBuilder",
 *     "form" = {
 *       "add" = "Drupal\movie_awards\Form\AwardMovieForm",
 *       "edit" = "Drupal\movie_awards\Form\AwardMovieForm",
 *       "delete" = "Drupal\movie_awards\Form\AwardMovieDeleteForm"
 *     }
 *   },
 *   config_prefix = "movie_award",
 *   admin_permission = "administer award movies",
 *   links = {
 *     "add-form" = "/admin/config/media/award-movie/add",
 *     "edit-form" = "/admin/config/media/award-movie/{movie_award}/edit",
 *     "delete-form" = "/admin/config/media/award-movie/{movie_award}/delete",
 *     "collection" = "/admin/config/media/award-movie"
 *   },
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *   },
 *   config_export = {
 *     "id",
 *     "label",
 *     "year",
 *     "movie_title"
 *   }
 * )
 */
class AwardMovie extends ConfigEntityBase {
  public $id;
  public $label;
  public $year;
  public $movie_title;
}
