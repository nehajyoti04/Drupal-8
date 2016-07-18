<?php

namespace Drupal\vppr\Routing;

use Drupal\Core\Routing\RouteBuildEvent;
use Drupal\Core\Routing\RoutingEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

//class VpprAlterRouteSubscriber implements EventSubscriberInterface {
////
////  /**
////   * {@inheritdoc}
////   */
//  public static function getSubscribedEvents() {
//    $events[RoutingEvents::ALTER] = 'alterRoutes';
//    return $events;
//  }
////
////  /**
////   * Alters existing routes.
////   *
////   * @param \Drupal\Core\Routing\RouteBuildEvent $event
////   *   The route building event.
////   */
//  public function alterRoutes(RouteBuildEvent $event) {
//    // Fetch the collection which can be altered.
//    $collection = $event->getRouteCollection();
//    // The event is fired multiple times so ensure that the user_page route
//    // is available.
//
////    dpm("collection");
////    dpm($collection);
////    if ($route = $collection->get('user_page') {
////      // As example add a new requirement.
////    $route->setRequirement('_role', 'anonymous');
////  }
//  }
////
//
//}

class VpprAlterRouteSubscriber{
//
//  /**
//   * {@inheritdoc}
//   */
  public static function getSubscribedEvents() {
    $events[RoutingEvents::ALTER] = 'alterRoutes';
    return $events;
  }
//
//  /**
//   * Alters existing routes.
//   *
//   * @param \Drupal\Core\Routing\RouteBuildEvent $event
//   *   The route building event.
//   */
  public function alterRoutes(RouteBuildEvent $event) {
    // Fetch the collection which can be altered.
    $collection = $event->getRouteCollection();
    // The event is fired multiple times so ensure that the user_page route
    // is available.

//    dpm("collection");
//    dpm($collection);
//    if ($route = $collection->get('user_page') {
//      // As example add a new requirement.
//    $route->setRequirement('_role', 'anonymous');
//  }
  }
//

}


//public function alterRoutes(RouteCollection $collection) {
////Find the route we want to alter
////dsm($collection);
//  $route = $collection->get('example.route.name');
////Make a change to the controller.
//  $route->setDefault('_controller', '\Drupal\example\Controller\IndexController::changed_callback_trouser_type_add_page');
//}
