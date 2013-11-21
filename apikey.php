<?php
/*
 +--------------------------------------------------------------------------+
 | Copyright IT Bliss LLC (c) 2013                                          |
 +--------------------------------------------------------------------------+
 | This program is free software: you can redistribute it and/or modify     |
 | it under the terms of the GNU Affero General Public License as published |
 | by the Free Software Foundation, either version 3 of the License, or     |
 | (at your option) any later version.                                      |
 |                                                                          |
 | This program is distributed in the hope that it will be useful,          |
 | but WITHOUT ANY WARRANTY; without even the implied warranty of           |
 | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            |
 | GNU Affero General Public License for more details.                      |
 |                                                                          |
 | You should have received a copy of the GNU Affero General Public License |
 | along with this program.  If not, see <http://www.gnu.org/licenses/>.    |
 +--------------------------------------------------------------------------+
*/

require_once 'apikey.civix.php';

/**
 * Implementation of hook_civicrm_config
 */
function apikey_civicrm_config(&$config) {
  _apikey_civix_civicrm_config($config);
}

/**
 * Implementation of hook_civicrm_xmlMenu
 *
 * @param $files array(string)
 */
function apikey_civicrm_xmlMenu(&$files) {
  _apikey_civix_civicrm_xmlMenu($files);
}

/**
 * Implementation of hook_civicrm_install
 */
function apikey_civicrm_install() {
  return _apikey_civix_civicrm_install();
}

/**
 * Implementation of hook_civicrm_uninstall
 */
function apikey_civicrm_uninstall() {
  return _apikey_civix_civicrm_uninstall();
}

/**
 * Implementation of hook_civicrm_enable
 */
function apikey_civicrm_enable() {
  return _apikey_civix_civicrm_enable();
}

/**
 * Implementation of hook_civicrm_disable
 */
function apikey_civicrm_disable() {
  return _apikey_civix_civicrm_disable();
}

/**
 * Implementation of hook_civicrm_upgrade
 *
 * @param $op string, the type of operation being performed; 'check' or 'enqueue'
 * @param $queue CRM_Queue_Queue, (for 'enqueue') the modifiable list of pending up upgrade tasks
 *
 * @return mixed  based on op. for 'check', returns array(boolean) (TRUE if upgrades are pending)
 *                for 'enqueue', returns void
 */
function apikey_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _apikey_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implementation of hook_civicrm_managed
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 */
function apikey_civicrm_managed(&$entities) {
  return _apikey_civix_civicrm_managed($entities);
}

/**
 * Implementation of hook_civicrm_tabs
 */
function apikey_civicrm_tabs( &$tabs, $contactID ) {
  $session = CRM_Core_Session::singleton();

  $is_admin = CRM_Core_Permission::check('administer CiviCRM') && CRM_Core_Permission::check('edit all contacts');
  $is_myself = ($contactID && ($contactID == $session->get('userID')));
  if ($is_admin || $is_myself) {
    $url = CRM_Utils_System::url( 'civicrm/contact/view/apikey', "reset=1&cid={$contactID}&snippet=1" );
    $tabs[] = array(
      'id' => 'apiKey',
      'url' => $url,
      'title' => 'API Key',
      'weight' => 300,
    );
  }
}