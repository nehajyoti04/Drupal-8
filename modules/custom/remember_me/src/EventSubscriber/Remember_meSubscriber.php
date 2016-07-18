<?php

namespace Drupal\remember_me\EventSubscriber;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class Remember_meSubscriber implements EventSubscriberInterface {

  public function addAccessAllowOriginHeaders(FilterResponseEvent $event) {
    $response= $event->getResponse();
    print '<pre>'; print_r("response"); print '</pre>';
//    print '<pre>'; print_r($response); print '</pre>';
//    $response->headers->set('Access-Control-Allow-Origin', '*');
  }


  public function xyz(GetResponseEvent $event) {

    $user = $this->accountProxy;
    if($user->id()) {
//      print '<pre>'; print_r("user"); print '</pre>';
//      print '<pre>'; print_r($user); print '</pre>';
    }
//    print '<pre>'; print_r("request"); print '</pre>';
//    $user = $this->accountProxy;
//    print '<pre>'; print_r($user->id()); print '</pre>';
//    $this->_remember_me_set_lifetime();
//    print '<pre>'; print_r($event); print '</pre>';

  }
  /**
   * {@inheritdoc}
   */
  static function getSubscribedEvents() {
//    $events[KernelEvents::RESPONSE][] = array('addAccessAllowOriginHeaders');
    $events[KernelEvents::REQUEST][] = array('xyz');
    return $events;

//    print '<pre>'; print_r("account proxy"); print '</pre>';
    // Load the current user.
//    $user = \Drupal::currentUser()->id();
//    $user = \Drupal\user\Entity\User::load(\Drupal::currentUser()->id());
  }

  public function _remember_me_set_lifetime() {


    print '<pre>'; print_r("inside helper function"); print '</pre>';
    // We have session started.
    // Lets close the session, change php cookie lifetime variable, and start
    // session again.
    // Prevent sess_write from persisting the session object at this time,
    // it will happen on shutdown.
//    drupal_save_session(FALSE);
//    session_write_close();
//    drupal_save_session(TRUE);
//
//    ini_set('session.cookie_lifetime', $cookie_lifetime);
//
//    drupal_session_started(FALSE);
//    drupal_session_initialize();
  }

  public function __construct() {
    $user = \Drupal::currentUser();
//    print '<pre>'; print_r("account proxy"); print '</pre>';
    $this->accountProxy = $user;
  }

}


