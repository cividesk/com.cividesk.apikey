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

class CRM_Contact_Page_View_APIKey extends CRM_Core_Page {

    function preProcess() {
        $this->_contactId = CRM_Utils_Request::retrieve('cid', 'Positive', $this, TRUE);
        $this->assign('contactId', $this->_contactId);

        $contact = new CRM_Contact_BAO_Contact();
        $contact->get('id', $this->_contactId);
        $this->_apiKey = $contact->api_key;
        $this->assign('apiKey', $this->_apiKey);

        // check logged in url permission
        CRM_Contact_Page_View::checkUserPermission($this);

        // set page title
        CRM_Contact_Page_View::setTitle($this->_contactId);

        $this->_action = CRM_Utils_Request::retrieve('action', 'String', $this, FALSE, 'browse');
        $this->assign('action', $this->_action);

        $isAdmin = CRM_Core_Permission::check('administer CiviCRM') && CRM_Core_Permission::check('edit all contacts');
        $session = CRM_Core_Session::singleton();
        $isMyself = ($this->_contactId && ($this->_contactId == $session->get('userID')));
        $this->assign('isAdmin', $isAdmin);
        $this->assign('isMyself', $isMyself);

        $urlParam = 'reset=1&action=add&cid=' . $this->_contactId;
        if ($this->_apiKey) {
            $urlParam = 'reset=1&action=edit&cid=' . $this->_contactId;
        }

        $this->assign('addApiKeyUrl', CRM_Utils_System::url('civicrm/contact/apikey', $urlParam));
    }

    /**
     * This function is called when action is update or new
     *
     * return null
     * @access public
     */
    function edit() {
        $controller = new CRM_Core_Controller_Simple('CRM_Contact_Form_APIKey', ts('API Key'), $this->_action);
        $controller->setEmbedded(TRUE);

        // set the userContext stack
        $session = CRM_Core_Session::singleton();
        $url = CRM_Utils_System::url('civicrm/contact/view/apikey', 'action=browse&selectedChild=apikey&cid=' . $this->_contactId
        );
        $session->pushUserContext($url);

        $controller->reset();
        $controller->set('contactId', $this->_contactId);
        $controller->process();
        $controller->run();
    }

    /**
     * This function is the main function that is called when the page loads,
     * it decides the which action has to be taken for the page.
     *
     * return null
     * @access public
     */
    function run() {

        $this->preProcess();

        if ($this->_action & (CRM_Core_Action::UPDATE | CRM_Core_Action::ADD)) {
            $this->edit();
        }

        return parent::run();
    }

}
