<?php

namespace Drupal\remember_me\EventSubscriber;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


use Drupal\Core\Authentication\AuthenticationProviderInterface;
use Drupal\Core\Session\AccountProxyInterface;




use Drupal\Core\Session\AccountInterface;


use Drupal\Core\Session;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
use Drupal\Core\Session\WriteSafeSessionHandler;

use Symfony\Component\HttpFoundation\RequestStack;



class Remember_meSubscriber implements EventSubscriberInterface {

  protected $started = false;


  public function addAccessAllowOriginHeaders(FilterResponseEvent $event) {
    $response= $event->getResponse();
    print '<pre>'; print_r("response"); print '</pre>';
//    print '<pre>'; print_r($response); print '</pre>';
//    $response->headers->set('Access-Control-Allow-Origin', '*');
  }


  public function xyz(GetResponseEvent $event) {

    $user = $this->accountProxy;


    $account = \Drupal::currentUser();
//    dpm("account id");
//    dpm($account->id());
//
//    dpm("user");
//    dpm($user);
//    dpm("account");
//    dpm($account);
//
//    dpm("user id");
//    dpm($user->id());
    if($user->id()) {
//
//
//      dpm("hello 123");
      $account = \Drupal\user\Entity\User::load(\Drupal::currentUser()->id());
      $remember_me_value = \Drupal::service('user.data')->get('remember_me', $account->id(), 'remember_me_value');
//      dpm("account");
//      dpm($account->id());
//      dpm("value");
//      dpm($value);
//      print '<pre>'; print_r("user"); print '</pre>';
//      print '<pre>'; print_r($user); print '</pre>';


//      dpm("remember value");
//      dpm($remember_me_value);
//      dpm("remember managed");
//      dpm(\Drupal::state()->get('remember_me_managed', 0));
////
      $remember_me_lifetime_value = \Drupal::state()->get('remember_me_lifetime', 604800);
//      dpm("remember me life time value");
//      dpm($remember_me_lifetime_value);
      if ($remember_me_value && \Drupal::state()->get('remember_me_managed', 0) != 0) {
//        // Set lifetime as configured via admin settings.
        dpm("inside if");
        if ($remember_me_lifetime_value != ini_get('session.cookie_lifetime')) {
          dpm("inside if if ");
          $this->_remember_me_set_lifetime($remember_me_lifetime_value);
        }
      }
      elseif (!isset($remember_me_value)) {
        dpm("inside else");
        // If we have cookie lifetime set already then unset it.
        if (0 != ini_get('session.cookie_lifetime')) {
          $this->_remember_me_set_lifetime(0);
        }
      }
//
//
//
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
//    $events[KernelEvents::REQUEST][] = array('xyz');
    $events[KernelEvents::RESPONSE][] = array('xyz');
    return $events;

//    print '<pre>'; print_r("account proxy"); print '</pre>';
    // Load the current user.
//    $user = \Drupal::currentUser()->id();
//    $user = \Drupal\user\Entity\User::load(\Drupal::currentUser()->id());
  }

  public function _remember_me_set_lifetime($cookie_lifetime) {


//    print '<pre>'; print_r("inside helper function"); print '</pre>';
    dpm("inside helper function");
    // We have session started.
    // Lets close the session, change php cookie lifetime variable, and start
    // session again.
    // Prevent sess_write from persisting the session object at this time,
    // it will happen on shutdown.
//    dpm("cookie life time ");
//    dpm($cookie_lifetime);



//    session_write_close();

//    ini_set('session.cookie_lifetime', $cookie_lifetime);
//
////    ini_set('session.cookie_lifetime', 86400);
//    ini_set('session.gc_maxlifetime', $cookie_lifetime);



    // Unset the session cookies.
//    $session_name = $this->getName();
//    $cookies = $this->requestStack->getCurrentRequest()->cookies;
//    if ($cookies->has($session_name)) {
//      $params = session_get_cookie_params();
//      setcookie($session_name, '', $cookie_lifetime, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
//
//    }


//    $this->sessionConfiguration;

//    $session_manager = $this->sessionManager;

    $session_manager = \Drupal::service('session_manager');
//    $session_manager->save(FALSE);
    dpm("session manager");
//    session_write_close();
//    $session_manager->save(TRUE);
    ini_set('session.cookie_lifetime', $cookie_lifetime);
    $session_manager->setOptions(array('cookie_lifetime' => $cookie_lifetime));

//    $session_manager->setSaveHandler(FALSE);

//    $session_manager->start();
//    dpm("session manager");
//    dpm($session_manager);

    $session = \Drupal::service('session');
//    $session->restart();
//     dpm("session");
//     dpm($session);


//    $session_manager->sessionHandler->isSessionWritable(), FALSE);

//    ->sessionHandler->isSessionWritable(), TRUE);

//    $session_manager->start();


    // Force-start a session.
    $session_manager->start();
// Check whether a session has been started.
    $session_manager->isStarted();
// Migrate the current session from anonymous to authenticated (or vice-versa).
    $session_manager->regenerate();
//    drupal_session_initialize();






//    $session = \Drupal::service('session');
//    // Alternatively
//    $session = $request->getSession();
//
//    // Force-start a session.
//    $session->start();
//    // Check whether a session has been started.
//    $session->isStarted();
//    // Migrate the current session from anonymous to authenticated (or vice-versa).
//    $session->migrate();

    // $session = \Drupal::service('session');
    // $session->save(FALSE);
    // session_write_close();
    // $session->save(TRUE);

    // ini_set('session.cookie_lifetime', $cookie_lifetime);



//     $session_manager = Drupal::service('session_manager');
//     dpm("session manager");
//     dpm($session_manager);

//    drupal_save_session(FALSE);
//    session_write_close();
//    drupal_save_session(TRUE);
//
//
//    ini_set('session.cookie_lifetime', $cookie_lifetime);
//
//    drupal_session_started(FALSE);
//    drupal_session_initialize();
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


