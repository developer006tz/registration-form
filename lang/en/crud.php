<?php

return [
    'common' => [
        'actions' => 'Actions',
        'create' => 'Create',
        'edit' => 'Edit',
        'update' => 'Update',
        'new' => 'New',
        'cancel' => 'Cancel',
        'attach' => 'Attach',
        'detach' => 'Detach',
        'save' => 'Save',
        'delete' => 'Delete',
        'delete_selected' => 'Delete selected',
        'search' => 'Search...',
        'back' => 'Back to Index',
        'are_you_sure' => 'Are you sure?',
        'no_items_found' => 'No items found',
        'created' => 'Successfully created',
        'saved' => 'Saved successfully',
        'removed' => 'Successfully removed',
    ],

    'users' => [
        'name' => 'Users',
        'index_title' => 'Users List',
        'new_title' => 'New User',
        'create_title' => 'Create User',
        'edit_title' => 'Edit User',
        'show_title' => 'Show User',
        'inputs' => [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'phone' => 'Phone',
            'dob' => 'Dob',
            'district_id' => 'District',
            'regions_id' => 'Regions',
        ],
    ],

    'all_regions' => [
        'name' => 'All Regions',
        'index_title' => 'AllRegions List',
        'new_title' => 'New Regions',
        'create_title' => 'Create Regions',
        'edit_title' => 'Edit Regions',
        'show_title' => 'Show Regions',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'districts' => [
        'name' => 'Districts',
        'index_title' => 'Districts List',
        'new_title' => 'New District',
        'create_title' => 'Create District',
        'edit_title' => 'Edit District',
        'show_title' => 'Show District',
        'inputs' => [
            'name' => 'Name',
            'regions_id' => 'Regions',
        ],
    ],

    'user_languages' => [
        'name' => 'User Languages',
        'index_title' => 'UserLanguages List',
        'new_title' => 'New User language',
        'create_title' => 'Create UserLanguage',
        'edit_title' => 'Edit UserLanguage',
        'show_title' => 'Show UserLanguage',
        'inputs' => [
            'user_id' => 'User',
            'language_id' => 'Language',
        ],
    ],

    'roles' => [
        'name' => 'Roles',
        'index_title' => 'Roles List',
        'create_title' => 'Create Role',
        'edit_title' => 'Edit Role',
        'show_title' => 'Show Role',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'permissions' => [
        'name' => 'Permissions',
        'index_title' => 'Permissions List',
        'create_title' => 'Create Permission',
        'edit_title' => 'Edit Permission',
        'show_title' => 'Show Permission',
        'inputs' => [
            'name' => 'Name',
        ],
    ],
];
