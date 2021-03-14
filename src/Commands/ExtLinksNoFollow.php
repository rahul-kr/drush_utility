<?php

namespace Drupal\drush_utility\Commands;

use Drush\Commands\DrushCommands;
use Drush\Exceptions\UserAbortException;
use Drupal\drush_utility\Utility\DrushHelper;

/**
 * A Drush commandfile.
 *
 * In addition to this file, you need a drush.services.yml
 * in root of your module, and a composer.json file that provides the name
 * of the services file to use.
 */
class ExtLinksNoFollow extends DrushCommands {

  /**
   * Drush command to update external links with no-follow property.
   *
   * @param string $type
   *   Content type as argument provided to the drush command.
   * @param int $nid
   *   To check the node id.
   * @param array $options
   *   An array.
   * @command ext_links:nofollow
   * @aliases ext-links extl-nf
   * @option $nid
   *   if you want to specify a single node_id for operation.
   * @option all
   *   to scan and update all the nodes of mentioned type.
   * @usage extl-nf article 5 OR extl-nf --all article
   */
  public function addAttNoFollow($type, $nid = 0, array $options = ['all' => FALSE]) {
    if (!$nid && !$options['all']) {
      throw new UserAbortException("Either pass second parameter nid or run command with --all option.");
    }
    elseif ($nid && is_int($nid) && !$options['all']) {
      $update_flag = DrushHelper::processNodeExtLinks($nid, $type);
      if ($update_flag == TRUE) {
        $this->output()->writeln("Node is updated");
      }
      else {
        $this->output()->writeln("Node id is not belongs to type $type ");
      }
    }
    elseif ($options['all']) {
      if ($this->io()->confirm("--all having the top priority and will execute for all nodes of type $type")) {
        $all_content_ids = DrushHelper::fetchNodeIds($type);
        if (!empty($all_content_ids)) {
          foreach ($all_content_ids as $nid) {
            DrushHelper::processNodeExtLinks($nid, $type);
          }
          $this->output()->writeln("All nodes are updated");
        }
        else {
          $this->output()->writeln("No any node is available for type $type");
        }
      }
      else {
        throw new UserAbortException("Command operation cancelled");
      }
    }
    else {
      $this->output()->writeln("Use command like -  extl-nf article 5 OR extl-nf --all article");
      throw new UserAbortException("Something is unusual");
    }
  }

}
