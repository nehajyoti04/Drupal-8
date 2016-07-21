<?php

/**
 * @file
 * Contains \Drupal\time_spent\Form\TimeSpentConfigForm.
 */

namespace Drupal\remember_me\Form;

use Drupal\Core\Datetime\Date;
use Drupal\Core\Form\ConfigFormBase;
//use Drupal\node\Entity\NodeType;
use Drupal\Core\Form\FormStateInterface;
//use Symfony\Component\HttpFoundation\Request;

class Remember_meConfigForm extends ConfigFormBase {
  public function getFormId() {
    return 'remember_me_admin_settings';
  }
  public function getEditableConfigNames() {
    return [
      'remember_me.settings',
    ];

  }
  public function buildForm(array $form, FormStateInterface $form_state) {

    $config = $this->config('remember_me.settings');

    global $user;

    $time_intervals = array(30, 3600, 10800, 21600, 43200, 86400, 172800, 259200, 604800, 1209600, 2592000, 5184000, 7776000);




   $options =  array_map(array(\Drupal::service('date.formatter'), 'formatInterval'), array_combine($time_intervals, $time_intervals));


//    $options = array_combine($time_intervals, $time_intervals);

//    dpm("options");
//    dpm($options);
//    $options = \DateFormatterInterface::formatInterval($options);

//    $options = array_map($this->format_interval(), $time_intervals);








//$date_service = \Drupal::service('date.formatter');
//$options = drupal_map_assoc(array(900, 1800, 3600, 7200, 10800, 21600, 32400, 43200,
//  64800, 86400, 172800, 259200, 604800, 1209600, 2419200), array($date_service, 'formatInterval'));




//    dpm("options");
//    dpm($options);










    $vars = array(
      'remember' => array(
        '#type' => 'item',
        '#title' => t('Remember me'),
//        '#value' => isset($user->data['remember_me']) ? t('Yes') : t('No'),
        '#value' => t('Yess'),
        '#description' => t('Current user chose at log in.'),
      ),
      'session' => array(
        '#type' => 'item',
        '#title' => t('Session lifetime'),
//        '#value' => format_interval(ini_get('session.cookie_lifetime')),
        '#description' => t('Currently configured session cookie lifetime.'),
      ),
    );
    $form['legend'] = array(
      '#type' => 'markup',
//      '#markup' => theme('remember_me_settings_display', array('vars' => $vars)),
    );

    $form['remember_me_managed'] = array(
      '#type' => 'checkbox',
      '#title' => t('Manage session lifetime'),
      '#default_value' => $config->get('remember_me_managed'),
      '#description' => t('Choose to manually overwrite the configuration value from settings.php.'),
    );
    $form['remember_me_lifetime'] = array(
      '#type' => 'select',
      '#title' => t('Lifetime'),
      '#default_value' => $config->get('remember_me_lifetime', 604800),
      '#options' => $options,
      '#description' => t('Duration a user will be remembered for. This setting is ignored if Manage session lifetime (above) is disabled.'),
    );
    $form['remember_me_checkbox'] = array(
      '#type' => 'checkbox',
      '#title' => t('Remember me field'),
      '#default_value' => $config->get('remember_me_checkbox', 1),
      '#description' => t('Default state of the "Remember me" field on the login forms.'),
    );
    $form['remember_me_checkbox_visible'] = array(
      '#type' => 'checkbox',
      '#title' => t('Remember me field visible'),
      '#default_value' => $config->get('remember_me_checkbox_visible', 1),
      '#description' => t('Should the "Remember me" field be visible on the login forms.'),
    );

    return parent::buildForm($form, $form_state);
  }

  // @TODO: Validate function
  // @TODO: Helper function
  // terms_of_use_js
  /**
   * Helper function for autocompletion
   */

  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Set values in variables.
    \Drupal::state()->set('remember_me_managed', $form_state->getValues()['remember_me_managed']);
    \Drupal::state()->set('remember_me_lifetime', $form_state->getValues()['remember_me_lifetime']);
    \Drupal::state()->set('remember_me_checkbox', $form_state->getValues()['remember_me_checkbox']);
    \Drupal::state()->set('remember_me_checkbox_visible', $form_state->getValues()['remember_me_checkbox_visible']);
//    $config = $this->config('remember_me.settings');
    $config = \Drupal::service('config.factory')->getEditable('remember_me.settings');
    $config->set('remember_me_managed', $form_state->getValues()['remember_me_managed']);
    $config->set('remember_me_lifetime', $form_state->getValues()['remember_me_lifetime']);
    $config->set('remember_me_checkbox', $form_state->getValues()['remember_me_checkbox']);
    $config->set('remember_me_checkbox_visible', $form_state->getValues()['remember_me_checkbox_visible']);
    $config->save();
    parent::submitForm($form, $form_state);
  }

  public function format_interval($interval, $granularity = 2, $langcode = NULL) {
    $units = array(
      '1 year|@count years' => 31536000,
      '1 month|@count months' => 2592000,
      '1 week|@count weeks' => 604800,
      '1 day|@count days' => 86400,
      '1 hour|@count hours' => 3600,
      '1 min|@count min' => 60,
      '1 sec|@count sec' => 1,
    );
    $output = '';
    foreach ($units as $key => $value) {
      $key = explode('|', $key);
      if ($interval >= $value) {
        $output .= ($output ? ' ' : '') . format_plural(floor($interval / $value), $key[0], $key[1], array(), array('langcode' => $langcode));
        $interval %= $value;
        $granularity--;
      }

      if ($granularity == 0) {
        break;
      }
    }
    return $output ? $output : t('0 sec', array(), array('langcode' => $langcode));
  }
}

