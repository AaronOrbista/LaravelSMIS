<?php

return [
    'userManagement'    => [
        'title'          => 'User management',
        'title_singular' => 'User management',
    ],
    'permission'        => [
        'title'          => 'Permissions',
        'title_singular' => 'Permission',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'title'             => 'Permission',
            'title_helper'      => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
    ],
    'role'              => [
        'title'          => 'Roles',
        'title_singular' => 'Role',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => '',
            'title'              => 'Role',
            'title_helper'       => '',
            'permissions'        => 'Permissions',
            'permissions_helper' => '',
            'created_at'         => 'Created at',
            'created_at_helper'  => '',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => '',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => '',
        ],
    ],
    'user'              => [
        'title'          => 'Users',
        'title_singular' => 'User',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => '',
            'name'                     => 'First Name',
            'name_helper'              => '',
            'username'                 => 'Username',
            'username_helper'          => '',
            'password'                 => 'Password',
            'password_helper'          => '',
            'password_confirmation'    => 'Confirm Password',
            'confirmation_helper'      => '',
            'roles'                    => 'Role',
            'roles_helper'             => '',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => '',
            'created_at'               => 'Created at',
            'created_at_helper'        => '',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => '',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => '',
            'middle_name'              => 'Middle Name',
            'middle_name_helper'       => 'This field is optional..',
            'last_name'                => 'Last Name',
            'last_name_helper'         => '',
            'gender'                   => 'Gender',
            'gender_helper'            => '',
            'position'                 => 'Position',
            'position_helper'          => '',
        ],
    ],
    'itemCategory'      => [
        'title'          => 'Consumable Supplies',
        'title_singular' => 'Consumable Supply',
    ],
    'requestor'         => [
        'title'          => 'Requestors',
        'title_singular' => 'Requestor',
    ],
    'brand'             => [
        'title'          => 'Brands',
        'title_singular' => 'Brand',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'name'              => 'Brand Name',
            'name_helper'       => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
    ],
    'item'              => [
        'title'          => 'Items',
        'title_singular' => 'Item',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => '',
            'name'                 => 'Item Name',
            'name_helper'          => '',
            'quantity'             => 'Item Quantity',
            'quantity_helper'      => '',
            'brand'                => 'Brand Name',
            'brand_helper'         => '',
            'item_category'        => 'Item Category',
            'item_category_helper' => '',
            'created_at'           => 'Created at',
            'created_at_helper'    => '',
            'updated_at'           => 'Updated at',
            'updated_at_helper'    => '',
            'deleted_at'           => 'Deleted at',
            'deleted_at_helper'    => '',
            'description'          => 'Item Description',
            'description_helper'   => '',
            'unit'                 => 'Item Unit',
            'unit_helper'          => '',
        ],
    ],
    'account'           => [
        'title'          => 'Accounts',
        'title_singular' => 'Account',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => '',
            'id_number'          => 'Id Number',
            'id_number_helper'   => '',
            'first_name'         => 'First Name',
            'first_name_helper'  => '',
            'middle_name'        => 'Middle Name',
            'middle_name_helper' => '',
            'last_name'          => 'Last Name',
            'last_name_helper'   => '',
            'designation'        => 'Designation',
            'designation_helper' => '',
            'department'         => 'Department',
            'department_helper'  => '',
            'created_at'         => 'Created at',
            'created_at_helper'  => '',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => '',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => '',
        ],
    ],
        'department'         => [
            'title'          => 'Departments',
            'title_singular' => 'Department',
            'fields'         => [
                'id'                => 'ID',
                'id_helper'         => '',
                'name'              => 'Department Name',
                'name_helper'       => '',
                'office'            => 'Office Name',
                'office_helper'     => '',
                'created_at'        => 'Created at',
                'created_at_helper' => '',
                'updated_at'        => 'Updated at',
                'updated_at_helper' => '',
                'deleted_at'        => 'Deleted at',
                'deleted_at_helper' => '',
        ],
    ],
    'approvedRequest'   => [
        'title'          => 'Approved Requests',
        'title_singular' => 'Approved Request',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => '',
            'control_number'        => 'Control Number',
            'control_number_helper' => '',
            'requestor'             => 'Requestor',
            'requestor_helper'      => '',
            'item'                  => 'Item Name',
            'item_helper'           => '',
            'created_at'            => 'Created at',
            'created_at_helper'     => '',
            'updated_at'            => 'Updated at',
            'updated_at_helper'     => '',
            'deleted_at'            => 'Deleted at',
            'deleted_at_helper'     => '',
            'brand'                 => 'Brand Name',
            'brand_helper'          => '',
            'quantity'              => 'Quantity',
            'quantity_helper'       => '',
            'unit'                  => 'Unit',
            'unit_helper'           => '',
            'date_requested'        => 'Date Requested',
            'date_requested_helper' => '',
            'department'            => 'Department',
            'department_helper'     => '',
            'purpose'               => 'Purpose',
            'purpose_helper'        => '',
            'description'           => 'Description',
            'description_helper'    => '',
        ],
    ],
    'itemReleaseRecord' => [
        'title'          => 'Item Release Records',
        'title_singular' => 'Item Release Record',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => '',
            'created_at'            => 'Created at',
            'created_at_helper'     => '',
            'updated_at'            => 'Updated at',
            'updated_at_helper'     => '',
            'deleted_at'            => 'Deleted at',
            'deleted_at_helper'     => '',
            'control_number'        => 'Control Number',
            'control_number_helper' => '',
            'date_requested'        => 'Date Requested',
            'date_requested_helper' => '',
            'received_by'           => 'Received By',
            'received_by_helper'    => 'name of the receiver',
            'claimed'               => 'Claimed',
            'claimed_helper'        => 'check if the requested item has been claimed',
        ],
    ],

    'supplier'           => [
        'title'          => 'Suppliers',
        'title_singular' => 'Supplier',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => '',
            'company_name'          => 'Company Name',
            'company_name_helper'   => '',
            'tin_number'            => 'TIN Number',
            'tin_number_helper'     => '',
            'contact_number'        => 'Contact Number',
            'contact_number_helper' => '',
            'address'               => 'Address',
            'address_helper'        => '',
            'created_at'            => 'Created at',
            'created_at_helper'     => '',
            'updated_at'            => 'Updated at',
            'updated_at_helper'     => '',
            'deleted_at'            => 'Deleted at',
            'deleted_at_helper'     => '',
        ],
    ],

    'itemRestock'           => [
        'title'          => 'Item Restocks',
        'title_singular' => 'Item Restock',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => '',
            'supplier'              => 'Supplier',
            'supplier_helper'       => '',
            'item'                  => 'Item Name',
            'item_helper'           => '',
            'brand'                 => 'Brand Name',
            'brand_helper'          => '',
            'quantity'              => 'Quantity',
            'quantity_helper'       => '',
            'status'                => 'Status',
            'status_helper'         => '',
            'created_at'            => 'Created at',
            'created_at_helper'     => '',
            'updated_at'            => 'Updated at',
            'updated_at_helper'     => '',
            'deleted_at'            => 'Deleted at',
            'deleted_at_helper'     => '',
        ],
    ],
];
