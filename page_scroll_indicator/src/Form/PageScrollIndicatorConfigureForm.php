<?php

/**
 * @file
 * Contains \Drupal\system\Form\PageScrollIndicatorConfigureForm.
 */

namespace Drupal\page_scroll_indicator\Form;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\ConfigFormBase;

/**
 * Configure page_scroll_indicator settings.
 */
class PageScrollIndicatorConfigureForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'page_scroll_indicator_configure_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['page_scroll_indicator.configure'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $page_scroll_indicator_config = $this->config('page_scroll_indicator.configure');

 $form['scroll_option'] = array(
    '#title' => t('Select Option for Scroll to use'),
    '#description' => t('Scroll comes with a lot of option for progress.'),
    '#type' => 'radios',
    '#options' => array(
      '1' => t('Straight line'),
      '2' => t('Circular progress'),
      '3' => t('Animated progress'),
      '4' => t('Tooltip progress'),
      '5' => t('Bottom line'),
    ),
    '#default_value' => $page_scroll_indicator_config->get('scroll_option'),
  );
  $form['scroll_progress_color'] = array(
    '#title' => t('Color code.'),
    '#description' => t('Default color for scroll progress is #ff0000.'),
    '#type' => 'textfield',
    '#default_value' => $page_scroll_indicator_config->get('scroll_progress_color'),
  );
  $form['scroll_for_admin'] = array(
    '#title' => t('Load in administration pages.'),
    '#description' => t('Page Scroll is disabled by default on administration pages. Check to enable'),
    '#type' => 'checkbox',
    '#default_value' => $page_scroll_indicator_config->get('scroll_for_admin'),
  );

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  // public function validateForm(array &$form, FormStateInterface $form_state) {
  //   // Set default values if fields are empty.
  //   if ($form_state->isValueEmpty('scroll_option')) {
  //     $form_state->setValueForElement($form['scroll_option'], $this->t('This text will appear on page_scroll_indicator bar. You may also include HTML.'));
  //   }
  //   if ($form_state->isValueEmpty('scroll_progress_color')) {
  //     $form_state->setValueForElement($form['scroll_progress_color'], $this->t('#EB593C'));
  //   }
  //   if ($form_state->isValueEmpty('msg_color_hover')) {
  //     $form_state->setValueForElement($form['msg_color_hover'], $this->t('#EB593C'));
  //   }
  //   if ($form_state->isValueEmpty('msg_delaytime')) {
  //     $form_state->setValueForElement($form['msg_delaytime'], $this->t('5000'));
  //   }
  //   parent::validateForm($form, $form_state);
  // }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('page_scroll_indicator.configure')
      ->set('scroll_option', $form_state->getValue('scroll_option'))
      ->set('scroll_progress_color', $form_state->getValue('scroll_progress_color'))
      ->set('scroll_for_admin', $form_state->getValue('scroll_for_admin'))
      ->save();
    parent::submitForm($form, $form_state);
  }
}
