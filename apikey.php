<?php

// phpcs:disable
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
// phpcs:enable

require_once 'apikey.civix.php';

/**
 * Implements hook_civicrm_config().
 */
function apikey_civicrm_config(&$config) {
  _apikey_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 */
function apikey_civicrm_xmlMenu(&$files) {
  _apikey_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 */
function apikey_civicrm_install() {
  return _apikey_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_uninstall().
 */
function apikey_civicrm_uninstall() {
  return _apikey_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 */
function apikey_civicrm_enable() {
  return _apikey_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 */
function apikey_civicrm_disable() {
  return _apikey_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 */
function apikey_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _apikey_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 */
function apikey_civicrm_managed(&$entities) {
  return _apikey_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_tabset().
 */
function apikey_civicrm_tabset($tabsetName, &$tabs, $context) {
  if ($tabsetName == 'civicrm/contact/view' && !empty($context['contact_id'])) {
    $contactID = $context['contact_id'];
    $is_admin = CRM_Core_Permission::check('administer CiviCRM', 'edit all contacts');
    $is_myself = ($contactID == CRM_Core_Session::getLoggedInContactID());
    if ($is_admin || $is_myself) {
      $url = CRM_Utils_System::url('civicrm/contact/view/apikey', "reset=1&cid={$contactID}&snippet=1");
      $tabs[] = [
        'id' => 'apiKey',
        'url' => $url,
        'title' => 'API Key',
        'weight' => 300,
        'icon' => 'crm-i fa-key',
        'count' => CRM_Core_DAO::getFieldValue('CRM_Contact_DAO_Contact', $contactID, 'api_key') ? 1 : 0,
      ];
    }
  }
}
