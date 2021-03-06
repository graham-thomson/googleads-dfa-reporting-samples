<?php
/*
 * Copyright 2015 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

// Require the base class.
require_once dirname(__DIR__) . "/BaseExample.php";

/**
 * This example creates a user role in a given DoubleClick Campaign Manager
 * subaccount. To get the subaccount ID, run GetSubaccounts. To get the
 * available permissions, run GetUserRolePermissions. To get the parent user
 * role ID, run GetUserRoles.
 *
 * Tags: userRoles.insert
 *
 * @author api.jimper@gmail.com (Jonathon Imperiosi)
 */
class CreateUserRole extends BaseExample {
  /**
   * (non-PHPdoc)
   * @see BaseExample::getInputParameters()
   * @return array
   */
  protected function getInputParameters() {
    return array(
        array('name' => 'user_profile_id',
              'display' => 'User Profile ID',
              'required' => true),
        array('name' => 'parent_user_role_id',
              'display' => 'Parent User Role ID',
              'required' => true),
        array('name' => 'subaccount_id',
              'display' => 'Subaccount ID',
              'required' => true),
        array('name' => 'permission_one',
              'display' => 'First Permission ID',
              'required' => true),
        array('name' => 'permission_two',
              'display' => 'Second Permission ID',
              'required' => true),
        array('name' => 'user_role_name',
              'display' => 'User Role Name',
              'required' => true)
    );
  }

  /**
   * (non-PHPdoc)
   * @see BaseExample::run()
   */
  public function run() {
    $values = $this->formValues;

    printf(
        '<h2>Creating user role with name "%s" under parent role ID %s</h2>',
        $values['user_role_name'], $values['parent_user_role_id']
    );

    $user_role = new Google_Service_Dfareporting_UserRole();
    $user_role->setName($values['user_role_name']);
    $user_role->setParentUserRoleId($values['parent_user_role_id']);
    $user_role->setPermissions(array(
        $values['permission_one'], $values['permission_two']
    ));
    $user_role->setSubaccountId($values['subaccount_id']);

    $result = $this->service->userRoles->insert(
        $values['user_profile_id'], $user_role
    );

    $this->printResultsTable('User role created.', array($result));
  }

  /**
   * (non-PHPdoc)
   * @see BaseExample::getName()
   * @return string
   */
  public function getName() {
    return 'Create User Role';
  }

  /**
   * (non-PHPdoc)
   * @see BaseExample::getResultsTableHeaders()
   * @return array
   */
  public function getResultsTableHeaders() {
    return array(
        'id' => 'User Role ID',
        'name' => 'User Role Name'
    );
  }
}
