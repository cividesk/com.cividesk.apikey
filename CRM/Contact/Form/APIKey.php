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

class CRM_Contact_Form_APIKey extends CRM_Core_Form {

    function preProcess() {
        $this->_action = CRM_Utils_Request::retrieve('action', 'String', $this, FALSE, 'add');
        $this->_contactId = CRM_Utils_Request::retrieve('cid', 'Positive', $this, TRUE);

        $this->_apiKey = null;
        if ($this->_contactId) {
            $this->_apiKey = CRM_Core_DAO::getFieldValue('CRM_Contact_DAO_Contact', $this->_contactId, 'api_key');
        }
    }

    function buildQuickForm() {
        $this->applyFilter('__ALL__', 'trim');
        $this->add('text', 'api_key', ts('API Key'), array('size' => "32", 'maxlength' => "32"));

        $buttons = array(
            array(
                'type' => 'upload',
                'name' => ts('Save'),
                'subName' => 'view',
                'isDefault' => TRUE,
            ),
            array(
                'type' => 'cancel',
                'name' => ts('Cancel'),
            ),
        );

        $this->addButtons($buttons);
    }

    /**
     * This function sets the default values for the form. Note that in edit/view mode
     * the default values are retrieved from the database
     *
     * @access public
     *
     * @return None
     */
    function setDefaultValues() {
        return array('api_key' => $this->_apiKey);
    }

    /**
     * Form submission of new/edit api is processed.
     *
     * @access public
     *
     * @return None
     */
    public function postProcess() {
        //get the submitted values in an array
        $params = $this->controller->exportValues($this->_name);

        if (!empty($this->_contactId)) {
            CRM_Core_DAO::setFieldValue('CRM_Contact_DAO_Contact', $this->_contactId, 'api_key', $params['api_key']);
        }

        if (!empty($params['api_key'])) {
          CRM_Core_Session::setStatus("This API key has been updated.");
        } else {
          CRM_Core_Session::setStatus("This API key has been deleted.");
        }
    }
}
