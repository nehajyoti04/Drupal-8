<?php

/**
* @file
* Contains Drupal\my_module\MyModuleServiceProvider
*/

namespace Drupal\vppr;

use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\Core\DependencyInjection\ServiceProviderBase;

/**
* Modifies the language manager service.
*/
class VpprServiceProvider extends ServiceProviderBase {

/**
* {@inheritdoc}
*/
  public function alter(ContainerBuilder $container) {
    // Overrides language_manager class to test domain language negotiation.
//    $definition = $container->getDefinition('language_manager');
//    $definition->setClass('Drupal\language_test\LanguageTestManager');
  }
}