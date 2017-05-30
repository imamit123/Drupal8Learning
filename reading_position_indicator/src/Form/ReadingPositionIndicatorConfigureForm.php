<?php

/**
 * @file
 * Contains \Drupal\system\Form\ReadingPositionIndicatorConfigureForm.
 */

namespace Drupal\reading_position_indicator\Form;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\ConfigFormBase;

/**
 * Configure reading_position_indicator settings.
 */
class ReadingPositionIndicatorConfigureForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'reading_position_indicator_configure_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['reading_position_indicator.configure'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $reading_position_indicator_config = $this->config('reading_position_indicator.configure');
   $form['reading_position_indicator_theme'] = array(
      '#title' => t('Select theme for Scroll to use'),
      '#description' => t('Scroll comes with a lot of themes for progress. Please select the one that you prefer.'),
      '#type' => 'radios',
      '#options' => array(
        '1' => t('Straight line'),
        '2' => t('Circular progress'),
        '3' => t('Animated progress'),
        '4' => t('Tooltip progress'),
      ),
      '#default_value' => $reading_position_indicator_config->get('reading_position_indicator_theme') //variable_get('reading_position_indicator_theme') ? variable_get('reading_position_indicator_theme') : 1,
    );

    $form['reading_position_indicator_color'] = array(
      '#title' => t('Color code.'),
      '#description' => t('Default color for scroll progress is #ff0000.'),
      '#type' => 'textfield',
      '#default_value' => $reading_position_indicator_config->get('reading_position_indicator_color') //variable_get('reading_position_indicator_color') ? variable_get('reading_position_indicator_color') : '#ff0000',
    );

    $form['reading_position_indicator_load_on_admin_enabled'] = array(
      '#title' => t('Load in administration pages.'),
      '#description' => t('SCROLL is disabled by default on administration pages. Check to enable'),
      '#type' => 'checkbox',
      '#default_value' => $reading_position_indicator_config->get('reading_position_indicator_load_on_admin_enabled') //variable_get('reading_position_indicator_load_on_admin_enabled') ? variable_get('reading_position_indicator_load_on_admin_enabled') : 0,
    );
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    // Set default values if fields are empty.
    if ($form_state->isValueEmpty('reading_position_indicator_theme')) {
      $form_state->setValueForElement($form['reading_position_indicator_theme'], $this->t('This text will appear on header bar. You may also include HTML.'));
    }
    if ($form_state->isValueEmpty('reading_position_indicator_color')) {
      $form_state->setValueForElement($form['reading_position_indicator_color'], $this->t('#EB593C'));
    }
    if ($form_state->isValueEmpty('reading_position_indicator_load_on_admin_enabled')) {
      $form_state->setValueForElement($form['reading_position_indicator_load_on_admin_enabled'], $this->t('#EB593C'));
    }
      parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('reading_position_indicator.configure')
      ->set('reading_position_indicator_theme', $form_state->getValue('reading_position_indicator_theme'))
      ->set('reading_position_indicator_color', $form_state->getValue('reading_position_indicator_color'))
      ->set('reading_position_indicator_load_on_admin_enabled', $form_state->getValue('reading_position_indicator_load_on_admin_enabled'))
     // ->set('msg_delaytime', $form_state->getValue('msg_delaytime'))
      ->save();
    parent::submitForm($form, $form_state);
  }
}
