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
    '#default_value' => $psi_config->get('scroll_progress_theme'),
  );
  $form['scroll_progress_color'] = array(
    '#title' => t('Color code.'),
    '#description' => t('Default color for scroll progress is #ff0000.'),
    '#type' => 'textfield',
    '#default_value' => $psi_config->get('scroll_progress_color'),
  );
  $form['scroll_progress_load_on_admin_enabled'] = array(
    '#title' => t('Load in administration pages.'),
    '#description' => t('SCROLL is disabled by default on administration pages. Check to enable'),
    '#type' => 'checkbox',
    '#default_value' => $psi_config->get('scroll_progress_load_on_admin_enabled'),
  );




    // $form['msg_text'] = array(
    //   '#title' => t('Text'),
    //   '#type' => 'textarea',
    //   '#description' => t('Insert text which will appear on the bar. You may also include HTML.'),
    //   '#default_value' => $psi_config->get('msg_text'),
    // );
    // $form['msg_color'] = array(
    //   '#title' => t('Color'),
    //   '#type' => 'textfield',
    //   '#description' => t('Insert the color code : example - "#FFFF00" or "red".'),
    //   '#default_value' => $psi_config->get('msg_color'),
    // );
    // $form['msg_color_hover'] = array(
    //   '#title' => t('Hover color'),
    //   '#type' => 'textfield',
    //   '#description' => t('Insert the color code for mouse hover : example - "#FFFF00" or "red".'),
    //   '#default_value' => $psi_config->get('msg_color_hover'),
    // );
    // $form['msg_delaytime'] = array(
    //   '#title' => t('Delay Time'),
    //   '#type' => 'textfield',
    //   '#description' => t('Insert the delay time: example - "5000" = 5 sec.'),
    //   '#default_value' => $psi_config->get('msg_delaytime'),
    // );
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  // public function validateForm(array &$form, FormStateInterface $form_state) {
  //   // Set default values if fields are empty.
  //   if ($form_state->isValueEmpty('scroll_progress_theme')) {
  //     $form_state->setValueForElement($form['scroll_progress_theme'], $this->t('This text will appear on Psi bar. You may also include HTML.'));
  //   }
  //   if ($form_state->isValueEmpty('msg_color')) {
  //     $form_state->setValueForElement($form['msg_color'], $this->t('#EB593C'));
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
    $this->config('psi.configure')
      ->set('scroll_progress_theme', $form_state->getValue('scroll_progress_theme'))
      ->set('scroll_progress_color', $form_state->getValue('scroll_progress_color'))
      ->set('scroll_progress_load_on_admin_enabled', $form_state->getValue('scroll_progress_load_on_admin_enabled'))
     // ->set('msg_delaytime', $form_state->getValue('msg_delaytime'))
      ->save();
    parent::submitForm($form, $form_state);
  }
}
