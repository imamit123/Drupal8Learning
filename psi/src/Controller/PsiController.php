<?php

 namespace Drupal\psi\Controller;

class PsiController {
  public function render() {
    return array(
      '#title' => 'Hello World!',
      '#markup' => 'Here is some content.',
        );
    }
}
