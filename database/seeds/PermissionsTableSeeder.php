<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => '1',
                'title' => 'user_management_access',
            ],
            [
                'id'    => '2',
                'title' => 'permission_create',
            ],
            [
                'id'    => '3',
                'title' => 'permission_edit',
            ],
            [
                'id'    => '4',
                'title' => 'permission_show',
            ],
            [
                'id'    => '5',
                'title' => 'permission_delete',
            ],
            [
                'id'    => '6',
                'title' => 'permission_access',
            ],
            [
                'id'    => '7',
                'title' => 'role_create',
            ],
            [
                'id'    => '8',
                'title' => 'role_edit',
            ],
            [
                'id'    => '9',
                'title' => 'role_show',
            ],
            [
                'id'    => '10',
                'title' => 'role_delete',
            ],
            [
                'id'    => '11',
                'title' => 'role_access',
            ],
            [
                'id'    => '12',
                'title' => 'user_create',
            ],
            [
                'id'    => '13',
                'title' => 'user_edit',
            ],
            [
                'id'    => '14',
                'title' => 'user_show',
            ],
            [
                'id'    => '15',
                'title' => 'user_delete',
            ],
            [
                'id'    => '16',
                'title' => 'user_access',
            ],
            [
                'id'    => '17',
                'title' => 'item_category_access',
            ],
            [
                'id'    => '18',
                'title' => 'requestor_access',
            ],
            [
                'id'    => '19',
                'title' => 'brand_create',
            ],
            [
                'id'    => '20',
                'title' => 'brand_edit',
            ],
            [
                'id'    => '21',
                'title' => 'brand_show',
            ],
            [
                'id'    => '22',
                'title' => 'brand_delete',
            ],
            [
                'id'    => '23',
                'title' => 'brand_access',
            ],
            [
                'id'    => '24',
                'title' => 'item_create',
            ],
            [
                'id'    => '25',
                'title' => 'item_edit',
            ],
            [
                'id'    => '26',
                'title' => 'item_show',
            ],
            [
                'id'    => '27',
                'title' => 'item_delete',
            ],
            [
                'id'    => '28',
                'title' => 'item_access',
            ],
            [
                'id'    => '29',
                'title' => 'account_create',
            ],
            [
                'id'    => '30',
                'title' => 'account_edit',
            ],
            [
                'id'    => '31',
                'title' => 'account_show',
            ],
            [
                'id'    => '32',
                'title' => 'account_delete',
            ],
            [
                'id'    => '33',
                'title' => 'account_access',
            ],
            [
                'id'    => '34',
                'title' => 'department_create',
            ],
            [
                'id'    => '35',
                'title' => 'department_edit',
            ],
            [
                'id'    => '36',
                'title' => 'department_show',
            ],
            [
                'id'    => '37',
                'title' => 'department_delete',
            ],
            [
                'id'    => '38',
                'title' => 'department_access',
            ],
            [
                'id'    => '39',
                'title' => 'approved_request_create',
            ],
            [
                'id'    => '40',
                'title' => 'approved_request_edit',
            ],
            [
                'id'    => '41',
                'title' => 'approved_request_show',
            ],
            [
                'id'    => '42',
                'title' => 'approved_request_delete',
            ],
            [
                'id'    => '43',
                'title' => 'approved_request_access',
            ],
            [
                'id'    => '44',
                'title' => 'item_release_record_create',
            ],
            [
                'id'    => '45',
                'title' => 'item_release_record_edit',
            ],
            [
                'id'    => '46',
                'title' => 'item_release_record_show',
            ],
            [
                'id'    => '47',
                'title' => 'item_release_record_delete',
            ],
            [
                'id'    => '48',
                'title' => 'item_release_record_access',
            ],
            [
                'id'    => '49',
                'title' => 'supplier_create',
            ],
            [
                'id'    => '50',
                'title' => 'supplier_edit',
            ],
            [
                'id'    => '51',
                'title' => 'supplier_show',
            ],
            [
                'id'    => '52',
                'title' => 'supplier_delete',
            ],
            [
                'id'    => '53',
                'title' => 'supplier_access',
            ],
            [
                'id'    => '54',
                'title' => 'item_restock_create',
            ],
            [
                'id'    => '55',
                'title' => 'item_restock_edit',
            ],
            [
                'id'    => '56',
                'title' => 'item_restock_show',
            ],
            [
                'id'    => '57',
                'title' => 'item_restock_delete',
            ],
            [
                'id'    => '58',
                'title' => 'item_restock_access',
            ],
        ];

        Permission::insert($permissions);
    }
}
