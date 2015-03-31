<?php
/**
 * User Profile Administration Panel.
 *
 * @package WordPress
 * @subpackage Administration
 */

/**
 * This is a profile page.
 *
 * @since unknown
 * @var bool
 */
define('IS_PROFILE_PAGE', true);
//print_r($_COOKIE);
/** Load User Editing Page */
require_once('user-edit.php');
?>
