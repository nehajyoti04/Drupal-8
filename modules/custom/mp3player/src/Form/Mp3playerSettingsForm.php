<?php

/**
 * @file
 * Contains \Drupal\remember_me\Form\Remember_meConfigForm.
 */

namespace Drupal\mp3player\Form;

use Drupal\Core\Datetime\Date;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;


class Mp3playerSettingsForm extends ConfigFormBase {
  public function getFormId() {
    return 'mp3player_settings';
  }
  public function getEditableConfigNames() {
    return [
      'mp3player.settings',
    ];

  }
  public function buildForm(array $form, FormStateInterface $form_state) {

    $config = $this->config('mp3player.settings');


    return parent::buildForm($form, $form_state);
  }

  /**
   * Implements hook_form_submit().
   *
   * @param array $form
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Set values in variables.
    $config = $this->config('mp3player.settings');
//    $config = \Drupal::service('config.factory')->getEditable('remember_me.settings');
//    $config->set('remember_me_managed', $form_state->getValues()['remember_me_managed']);
//    $config->set('remember_me_lifetime', $form_state->getValues()['remember_me_lifetime']);
//    $config->set('remember_me_checkbox', $form_state->getValues()['remember_me_checkbox']);
//    $config->set('remember_me_checkbox_visible', $form_state->getValues()['remember_me_checkbox_visible']);
    $config->save();
    parent::submitForm($form, $form_state);
  }

  /**
   * Helper function to display formatted time interval.
   * @param array $time_intervals
   * @param int $granularity
   * @param null $langcode
   * @return array
   */
  function build_options(array $time_intervals, $granularity = 2, $langcode = NULL) {
    $callback = function ($value) use ($granularity, $langcode) {
      return \Drupal::service('date.formatter')->formatInterval($value, $granularity, $langcode);
    };
    return array_combine($time_intervals, array_map($callback, $time_intervals));
  }
}

