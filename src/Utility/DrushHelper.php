<?php

namespace Drupal\drush_utility\Utility;

use Drupal\node\Entity\Node;
use Drupal\Component\Utility\Html;

/**
 * Helper class for defining methods of custom drush commands.
 *
 * @ingroup utility
 */
class DrushHelper {

  /**
   * Helper function to process the node for external links.
   */
  public static function processNodeExtLinks($node_id, $bundle) {
    $node = Node::load($node_id);
    if ($node->bundle() == $bundle) {
      $node->get('body')->value;
      $html_dom = Html::load($node->get('body')->value);
      $links = $html_dom->getElementsByTagName('a');
      foreach ($links as $link) {
        $url = parse_url($link->getAttribute('href'));
        if (isset($url['host'])) {
          $link->setAttribute('rel', 'nofollow');
        }
      }
      $node->body->value = Html::serialize($html_dom);
      $node->save();
    }
    else {
      return FALSE;
    }
    return TRUE;
  }

  /**
   * Helper function to fetch the node ids of a given type.
   */
  public static function fetchNodeIds($bundle) {
    $bundle_nids = \Drupal::entityQuery('node')
      ->condition('type', $bundle)
      ->condition('status', '1');
    return $bundle_nids->execute();
  }

}
