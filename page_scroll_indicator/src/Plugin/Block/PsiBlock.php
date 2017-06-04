<?php


/**
 * @file
 */
namespace Drupal\psi\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Psi' Block
 * @Block(
 * id = "block_psi",
 * admin_label = @Translation("PSI block"),
 * )
 */
class PsiBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    return array (
      '#type' => 'markup',
          '#markup' => '<h2>Foo Bar</h2>',
    );
  }

}

