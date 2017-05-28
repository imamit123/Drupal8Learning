<?php
 
 namespace Drupal\admin_to_user\Controller;
/**
 * @file
 * Allows privileged users to masquerade as another user.
 */

use Drupal\Core\Entity\Display\EntityViewDisplayInterface;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Core\Url;
use Drupal\user\Entity\User;
use Drupal\user\UserInterface;


class AdminToUserController {
  public function render() {
  	$uid = 1; //The user ID
  	 $user = \Drupal\user\Entity\User::load($uid);
  	 $name = $user->getUsername();
  	 $name1 = $user->get('name')->value;
  	 $name12 = $user->get('uid')->value;
  	 //$id = $user->getUseruid();
  	print_r($name12);

    return array(
      '#title' => $name12,
      '#markup' => 'Here is some content.',
        );
    }
}