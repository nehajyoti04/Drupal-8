<?php

namespace Drupal\vppr\Access;

use Drupal\Core\Routing\Access\AccessInterface;
use Drupal\Core\Session\AccountInterface;
use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Checks access for displaying configuration translation page.
 */
class CustomAccessCheck implements AccessInterface {

  /**
   * A custom access check.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *   Run access checks for this account.
   */
  public function access(AccountInterface $account) {
    // Check permissions and combine that with any custom access checking needed. Pass forward
    // parameters from the route and/or request as needed.
    print '<pre>'; print_r("hello 123"); print '</pre>';
    return TRUE;
//    return $account->hasPermission('do example things') && $this->someOtherCustomCondition();
//    return AccessResult::allowedIf($account->hasPermission('Administer vocabulary 1 vocabulary terms v'));
  }
}