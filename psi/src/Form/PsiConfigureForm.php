<?php

/**
 * @file
 * Contains \Drupal\system\Form\PsiConfigureForm.
 */

namespace Drupal\psi\Form;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\ConfigFormBase;

/**
 * Configure Psi settings.
 */
class PsiConfigureForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'psi_configure_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['psi.configure'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $psi_config = $this->config('psi.configure');
    $form['msg_text'] = array(
      '#title' => t('Text'),
      '#type' => 'textarea',
      '#description' => t('Insert text which will appear on the bar. You may also include HTML.'),
      '#default_value' => $psi_config->get('msg_text'),
    );
    $form['msg_color'] = array(
      '#title' => t('Color'),
      '#type' => 'textfield',
      '#description' => t('Insert the color code : example - "#FFFF00" or "red".'),
      '#default_value' => $psi_config->get('msg_color'),
    );
    $form['msg_color_hover'] = array(
      '#title' => t('Hover color'),
      '#type' => 'textfield',
      '#description' => t('Insert the color code for mouse hover : example - "#FFFF00" or "red".'),
      '#default_value' => $psi_config->get('msg_color_hover'),
    );
    $form['msg_delaytime'] = array(
      '#title' => t('Delay Time'),
      '#type' => 'textfield',
      '#description' => t('Insert the delay time: example - "5000" = 5 sec.'),
      '#default_value' => $psi_config->get('msg_delaytime'),
    );
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    // Set default values if fields are empty.
    if ($form_state->isValueEmpty('msg_text')) {
      $form_state->setValueForElement($form['msg_text'], $this->t('This text will appear on Psi bar. You may also include HTML.'));
    }
    if ($form_state->isValueEmpty('msg_color')) {
      $form_state->setValueForElement($form['msg_color'], $this->t('#EB593C'));
    }
    if ($form_state->isValueEmpty('msg_color_hover')) {
      $form_state->setValueForElement($form['msg_color_hover'], $this->t('#EB593C'));
    }
    if ($form_state->isValueEmpty('msg_delaytime')) {
      $form_state->setValueForElement($form['msg_delaytime'], $this->t('5000'));
    }
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('psi.configure')
      ->set('msg_text', $form_state->getValue('msg_text'))
      ->set('msg_color', $form_state->getValue('msg_color'))
      ->set('msg_color_hover', $form_state->getValue('msg_color_hover'))
      ->set('msg_delaytime', $form_state->getValue('msg_delaytime'))
      ->save();
    parent::submitForm($form, $form_state);
  }
}
