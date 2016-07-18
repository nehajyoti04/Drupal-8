<?php

namespace Drupal\vppr;

//namespace Drupal\filter;

use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Entity\EntityManagerInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Symfony\Component\DependencyInjection\ContainerInterface;
  use Drupal\taxonomy\Entity\Vocabulary;


//use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
//use Drupal\Core\Entity\EntityManagerInterface;
//use Drupal\Core\StringTranslation\StringTranslationTrait;
//use Symfony\Component\DependencyInjection\ContainerInterface;
//
//use Drupal\Core\Extension\ModuleHandlerInterface;
//use Drupal\Core\Form\FormStateInterface;
//use Drupal\Core\KeyValueStore\KeyValueStoreExpirableInterface;
//use Drupal\user\Form\UserPermissionsForm;
//use Drupal\user\PermissionHandlerInterface;
//use Drupal\user\RoleStorageInterface;
//use Symfony\Component\DependencyInjection\ContainerInterface;

class VpprPermissions implements ContainerInjectionInterface {

  use StringTranslationTrait;


  /**
   * The entity manager.
   *
   * @var \Drupal\Core\Entity\EntityManagerInterface
   */
  protected $entityManager;

  /**
   * Constructs a new FilterPermissions instance.
   *
   * @param \Drupal\Core\Entity\EntityManagerInterface $entity_manager
   *   The entity manager.
   */
  public function __construct(EntityManagerInterface $entity_manager) {
    $this->entityManager = $entity_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static($container->get('entity.manager'));
  }

  public function permissions() {
    $perms = [];
    $names = taxonomy_vocabulary_get_names();
    $vocabularies = Vocabulary::loadMultiple($names);
    foreach ($vocabularies as $vocabulary) {
      $perms['administer ' . $vocabulary->id() . ' vocabulary terms'] = array(
        'title' => t('Administer %name vocabulary terms', array('%name' => $vocabulary->label())),
      );

      $perms['administer ' . $vocabulary->id() . ' vocabulary terms'] = array(
        'title' => t('Administer %name vocabulary terms %vid',
          array(
            '%name' => $vocabulary->label(),
            '%vid' => $vocabulary->id(),
            )
        ),
      );
    }
    return $perms;
  }
}
