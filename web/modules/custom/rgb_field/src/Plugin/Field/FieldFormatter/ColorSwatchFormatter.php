<?php
namespace Drupal\rgb_field\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;

/**
 * Plugin implementation of the 'color_swatch_formatter' formatter.
 *
 * @FieldFormatter(
 *   id = "color_swatch_formatter",
 *   label = @Translation("Color Swatch"),
 *   field_types = {
 *     "hex_widget"
 *   }
 * )
 */
class ColorSwatchFormatter extends FormatterBase
{

    public function viewElements(FieldItemListInterface $items, $langcode)
    {
        $elements = [];

        foreach ($items as $delta => $item) {
            // Ensure we have valid values before processing
            if (! $item->isEmpty()) {
                // Convert values to integers, defaulting to 0 if invalid
                $r = max(0, min(255, (int) $item->r));
                $g = max(0, min(255, (int) $item->g));
                $b = max(0, min(255, (int) $item->b));

                // Build the hex code
                $hex = sprintf("#%02x%02x%02x", $r, $g, $b);

                $elements[$delta] = [
                    '#type'     => 'inline_template',
                    '#template' => '<div style="display:inline-block; width:50px; height:50px; background-color:{{ hex }}; border:1px solid #000;"></div>',
                    '#context'  => ['hex' => $hex],
                ];
            }
        }

        return $elements;
    }
}
