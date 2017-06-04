<?php

 namespace Drupal\psi\Controller;

class PsiController {
  public function render() {
  	  $config = \Drupal::config('psi.configure');
      $colour = $config->get('msg_color');
    return array(
      '#title' => $colour,
      '#markup' => 'Here is some content.',
        );
    }
}
