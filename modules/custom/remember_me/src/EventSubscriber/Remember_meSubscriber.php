<?php

namespace Drupal\remember_me\EventSubscriber;

use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Drupal\Core\Authentication\AuthenticationProviderInterface;
use Drupal\Core\Session\AccountProxyInterface;
use Drupal\Core\Session;

class Remember_meSubscriber implements EventSubscriberInterface {

  protected $started = false;

//  public function addAccessAllowOriginHeaders(FilterResponseEvent $event) {
//    $response= $event->getResponse();
//    print '<pre>'; print_r("response"); print '</pre>';
//
//  }


  public function get_remember_me_session_configurations() {

    $user = $this->accountProxy;

    $account = \Drupal::currentUser();
    $session_manager = \Drupal::service('session_manager');

    if($user->id()) {

      $account = \Drupal\user\Entity\User::load(\Drupal::currentUser()->id());
      $remember_me_value = \Drupal::service('user.data')->get('remember_me', $account->id(), 'remember_me_value');

      $remember_me_lifetime_value = \Drupal::state()->get('remember_me_lifetime', 604800);

      if ($remember_me_value && \Drupal::state()->get('remember_me_managed', 0) != 0) {
        // Set lifetime as configured via admin settings.
        if ($remember_me_lifetime_value != ini_get('session.cookie_lifetime')) {

          $this->_remember_me_set_lifetime($remember_me_lifetime_value);
        }
      }
      elseif (!isset($remember_me_value)) {

        // If we have cookie lifetime set already then unset it.
        if (0 != ini_get('session.cookie_lifetime')) {
          $this->_remember_me_set_lifetime(0);
        }
      }

    }

  }



  /**
   * {@inheritdoc}
   */
  static function getSubscribedEvents() {
    $events[KernelEvents::RESPONSE][] = array('get_remember_me_session_configurations');
    return $events;
  }

  public function _remember_me_set_lifetime($cookie_lifetime) {

    $session_manager = \Drupal::service('session_manager');

    $session_manager->setOptions(array('cookie_lifetime' => $cookie_lifetime));

    // Force-start a session.
    $session_manager->start();
    // Check whether a session has been started.
    $session_manager->isStarted();
    // Migrate the current session from anonymous to authenticated (or vice-versa).
    $session_manager->regenerate();

  }

//  public function __construct() {
//    $user = \Drupal::currentUser();
////    print '<pre>'; print_r("account proxy"); print '</pre>';
//    $this->accountProxy = $user;
//  }

//  public function __construct(AccountProxyInterface $account_proxy) {
//    $this->accountProxy = $account_proxy;
//  }

  public function __construct(AuthenticationProviderInterface $authentication_provider, AccountProxyInterface $account_proxy) {
    $this->authenticationProvider = $authentication_provider;
//    $this->filter = ($authentication_provider instanceof AuthenticationProviderFilterInterface) ? $authentication_provider : NULL;
//    $this->challengeProvider = ($authentication_provider instanceof AuthenticationProviderChallengeInterface) ? $authentication_provider : NULL;
    $this->accountProxy = $account_proxy;

  }

}


