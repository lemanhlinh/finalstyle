<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use App\Models as Database;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = static::getDefaultPermission();

        foreach($permissions as $permission ) {
            Permission::updateOrCreate($permission);
        }

        $allPermissionNames = Database\Permission::pluck('name')->toArray();

        $roleAdmin = Database\Role::updateOrCreate([
            'name' => 'admin',
            'display_name' => 'Admin',
            'guard_name' => 'web',
        ]);

        $roleAdmin->givePermissionTo($allPermissionNames);

        $user = Database\User::find(1);

        if ($user) {
            $user->assignRole($roleAdmin);
        }
    }

    public static function getDefaultPermission()
    {
        return [
            ['name' => 'view_user', 'display_name' => 'Xem danh sách người dùng', 'guard_name' => 'web'],
            ['name' => 'create_user', 'display_name' => 'Thêm mới người dùng', 'guard_name' => 'web'],
            ['name' => 'edit_user', 'display_name' => 'Sửa thông tin người dùng', 'guard_name' => 'web'],
            ['name' => 'delete_user', 'display_name' => 'Xóa người dùng', 'guard_name' => 'web'],

            ['name' => 'view_role', 'display_name' => 'Xem danh sách phân quyền', 'guard_name' => 'web'],
            ['name' => 'create_role', 'display_name' => 'Thêm mới phân quyền', 'guard_name' => 'web'],
            ['name' => 'edit_role', 'display_name' => 'Sửa thông tin phân quyền', 'guard_name' => 'web'],
            ['name' => 'delete_role', 'display_name' => 'Xóa phân quyền', 'guard_name' => 'web'],

            ['name' => 'view_answer_question', 'display_name' => 'Xem danh sách hỏi đáp', 'guard_name' => 'web'],
            ['name' => 'create_answer_question', 'display_name' => 'Thêm mới hỏi đáp', 'guard_name' => 'web'],
            ['name' => 'edit_answer_question', 'display_name' => 'Sửa thông tin hỏi đáp', 'guard_name' => 'web'],
            ['name' => 'delete_answer_question', 'display_name' => 'Xóa hỏi đáp', 'guard_name' => 'web'],

            ['name' => 'view_article', 'display_name' => 'Xem danh sách tin tức', 'guard_name' => 'web'],
            ['name' => 'create_article', 'display_name' => 'Thêm mới tin tức', 'guard_name' => 'web'],
            ['name' => 'edit_article', 'display_name' => 'Sửa thông tin tức', 'guard_name' => 'web'],
            ['name' => 'delete_article', 'display_name' => 'Xóa tin tức', 'guard_name' => 'web'],
        ];
    }
}
