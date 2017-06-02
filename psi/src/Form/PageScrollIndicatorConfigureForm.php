<?php

/**
 * @file
 * Contains \Drupal\system\Form\PageScrollIndicatorConfigureForm.
 */

namespace Drupal\psi\Form;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\ConfigFormBase;


/**
 * Configure Psi settings.
 */
class PageScrollIndicatorConfigureForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'psi1_configure_settings';
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
    $psi1_config = $this->config('psi.configure');

    $form['scroll_progress_theme'] = array(
      '#title' => t('Select theme for Scroll to use'),
      '#description' => t('Scroll comes with a lot of themes for progress. Please select the one that you prefer.'),
      '#type' => 'radios',
      '#options' => array(
        '1' => t('Straight line'),
        '2' => t('Circular progress'),
        '3' => t('Animated progress'),
        '4' => t('Tooltip progress'),
        '5' => t('Bottom line'),
    ),
    '#default_value' => $psi1_config->get('scroll_progress_theme'),
  ); 

  $form['scroll_progress_color'] = array(
    '#title' => t('Color code.'),
    '#description' => t('Default color for scroll progress is #ff0000.'),
    '#type' => 'textfield',
    '#default_value' => $psi1_config->get('scroll_progress_color') : '#ff0000',
  );
  $form['scroll_progress_load_on_admin_enabled'] = array(
    '#title' => t('Load in administration pages.'),
    '#description' => t('SCROLL is disabled by default on administration pages. Check to enable'),
    '#type' => 'checkbox',
    '#default_value' => $psi1_config->get('scroll_progress_load_on_admin_enabled') ? $psi1_config->get('scroll_progress_load_on_admin_enabled') : 0,
  );
    
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    // Set default values if fields are empty.
    if ($form_state->isValueEmpty('scroll_progress_theme')) {
      $form_state->setValueForElement($form['scroll_progress_theme'], $this->t('This text will appear on Psi bar. You may also include HTML.'));
    }
    if ($form_state->isValueEmpty('scroll_progress_color')) {
      $form_state->setValueForElement($form['scroll_progress_color'], $this->t('#EB593C'));
    }
    if ($form_state->isValueEmpty('scroll_progress_color')) {
      $form_state->setValueForElement($form['scroll_progress_color'], $this->t('#EB593C'));
    }
    
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('psi.configure')
      ->set('scroll_progress_theme', $form_state->getValue('scroll_progress_theme'))
      ->set('scroll_progress_color', $form_state->getValue('scroll_progress_color'))
      ->set('scroll_progress_color', $form_state->getValue('scroll_progress_color'))
     // ->set('msg_delaytime', $form_state->getValue('msg_delaytime'))
      ->save();
    parent::submitForm($form, $form_state);
  }
}
