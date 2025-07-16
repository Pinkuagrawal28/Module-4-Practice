<?php

namespace Drupal\rgb_field\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;

/**
 * Plugin implementation of the 'color_code_formatter' formatter.
 *
 * @FieldFormatter(
 *   id = "color_code_formatter",
 *   label = @Translation("Color Code"),
 *   field_types = {
 *     "rgb_color"
 *   }
 * )
 */

class ColorCodeFormatter extends FormatterBase {

  public function viewelements(FieldItemListInterface $items, $langcode){
    $elements = [];
    foreach ($items as $delta => $item){
      $hex = sprintf("#%02x%02x%02x", $item->r, $item->g, $item->b);
      $elements[$delta] = [
        '#markup' => $hex
      ];
    }
    return $elements;
  }
}