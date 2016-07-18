<?php

namespace Drupal\vppr\Routing;

use Drupal\Core\Routing\RouteBuildEvent;
use Drupal\Core\Routing\RoutingEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;
use Drupal\taxonomy\Entity\Vocabulary;

//class VpprAlterRouteSubscriber implements EventSubscriberInterface {
//
//  /**
//   * {@inheritdoc}
//   */
//  public static function getSubscribedEvents() {
//    $events[RoutingEvents::ALTER] = 'alterRoutes';
//    return $events;
//  }
//
//  /**
//   * Alters existing routes.
//   *
//   * @param \Drupal\Core\Routing\RouteBuildEvent $event
//   *   The route building event.
//   */
//  public function alterRoutes(RouteBuildEvent $event) {
//    // Fetch the collection which can be altered.
//    $collection = $event->getRouteCollection();
//    // The event is fired multiple times so ensure that the user_page route
//    // is available.
//
//    dpm("collection");
//    dpm($collection);
////    if ($route = $collection->get('user_page') {
////      // As example add a new requirement.
////    $route->setRequirement('_role', 'anonymous');
////  }
//  }
//
//}


class RouteSubscriber extends RouteSubscriberBase {

  /**
   * {@inheritdoc}
   */
  public function alterRoutes(RouteCollection $collection) {
    print "collection";
//    print '<pre>'; print_r($collection); print '</pre>';
    // dpm("collection");
    // dpm($collection);
    // Change path '/user/login' to '/login'.
    if ($route = $collection->get('entity.taxonomy_vocabulary.collection')) {
      $route->setRequirement('_permission', 'Hello title');
//      print '<pre>'; print_r($route); print '</pre>';



      $names = taxonomy_vocabulary_get_names();
      $vocabularies = Vocabulary::loadMultiple($names);
      foreach ($vocabularies as $vocabulary) {
        $perms['administer ' . $vocabulary->id() . ' vocabulary terms'] = array(
          'title' => t('Administer %name vocabulary terms', array('%name' => $vocabulary->label())),
        );
      }


//      print '<pre>'; print_r($collection); print '</pre>';
      // dpm("route");
      // dpm($route);
//      $route->setPath('/login');
    }
    // Always deny access to '/user/logout'.
    // Note that the second parameter of setRequirement() is a string.
//    if ($route = $collection->get('user.logout')) {
//      $route->setRequirement('_access', 'FALSE');
//    }
  }


//  public function routes(RouteCollection $collection) {
//    foreach (trousers_get_types() as $type) {
//      $route = new Route(
//      // the url path to match
//        'trousers/add/' . $type,
//        // the defaults (see the trousers.routing.yml for structure)
//        array(
//          '_title' => $type->title,
//          '_controller' => '\Drupal\trousers\Controller\TrouserController::addType',
//          'type' => $type->machine_name,
//        ),
//        // the requirements
//        array(
//          '_permission' => 'create ' . $type-type,
//        )
//      );
//      // Add our route to the collection with a unique key.
//      $collection->add('trousers.add.' . $type->machine_name, $route);
//    }
//  }

}






//<?php
//
//namespace Drupal\vppr\Access;
//
//use Drupal\Core\Access\StaticAccessCheckInterface;
//use Symfony\Component\Routing\Route;
//use Symfony\Component\HttpFoundation\Request;
//
//class RouteSubscriber implements StaticAccessCheckInterface {
//
//  public function appliesTo() {
//    return '_access_trousers_has_legs';
//  }
//
//  public function access(Route $route, Request $request, AccountInterface $account) {
//    if (!$account->hasPermission("Hello title")) { // check if a user has legs
//      print "deny";
//      return static::DENY; // denied! No legs.
//    }
//    return static::ALLOW; // OK to access trousers
//    print "allow";
//  }
//}