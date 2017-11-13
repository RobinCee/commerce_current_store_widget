<?php

namespace Drupal\commerce_current_store_widget\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Session\AccountInterface;

/**
 * Provides a block displaying the current store title.
 *
 * @Block(
 *   id = "current_store_block",
 *   admin_label = @Translation("Current store"),
 * )
 */
class CurrentStoreBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    // Call the current store resolver service.
    if ($current_store = \Drupal::service('commerce_store.current_store')->getStore()) {
      $store_name = check_markup($current_store->getName());
      return  [
        '#markup' => $store_name,
      ];
    }
  }

  /**
   * {@inheritdoc}
   */
  protected function blockAccess(AccountInterface $account) {
    return AccessResult::allowedIfHasPermission($account, 'view current store block');
  }

}
