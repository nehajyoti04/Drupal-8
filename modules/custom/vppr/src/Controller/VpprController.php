<?php
/**
* @file
* Contains \Drupal\example\Controller\ExamleController.
*/

namespace Drupal\vppr\Controller;

use Drupal\Core\Session\AccountInterface;
use Symfony\Component\HttpFoundation\Request;

/**
* Builds an example page.
*/
class VpprController {

/**
* Checks access for a specific request.
*
* @param \Drupal\Core\Session\AccountInterface $account
*   Run access checks for this account.
*/
public function access(AccountInterface $account) {

  print '<pre>'; print_r(" vppr controller"); print '</pre>';

  return TRUE;
// Check permissions and combine that with any custom access checking needed. Pass forward
// parameters from the route and/or request as needed.
//return AccessResult::allowedIf($account->hasPermission('Administer vocabulary 1 vocabulary terms v'));
}
}