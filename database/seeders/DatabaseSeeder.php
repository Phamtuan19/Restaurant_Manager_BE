<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        DB::table('roles')->insert([
            'name' => 'Manage',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('roles')->insert([
            'name' => 'Member',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin1234'),
            'role_id' => 1
        ]);

        DB::table('status_product')->insert([
            'name' => 'Còn hàng',
        ]);

        DB::table('status_product')->insert([
            'name' => 'hết hàng',
        ]);

        // Status Table
        $stats_table = [
            [
                'name' => 'available',
            ],
            [
                'name' => 'occupied',
            ],
            [
                'name' => 'reserved',
            ],
        ];

        foreach ($stats_table as $value) {
            DB::table('status_table')->insert($value);
        }


        // Status invoice
        DB::table('status_invoice')->insert([
            'name' => 'đang chờ đồ',
        ]);

        DB::table('status_invoice')->insert([
            'name' => 'đang dùng',
        ]);

        DB::table('status_invoice')->insert([
            'name' => 'đã thanh toán',
        ]);

        DB::table('status_invoice_detail')->insert([
            'name' => 'đang làm',
        ]);

        DB::table('status_invoice_detail')->insert([
            'name' => 'đã xong',
        ]);

        $status_booking = [
            [
                'name' => 'Unconfirmed',
                'description' => 'Đặt bàn mới được tạo ra và chưa được xác nhận',
            ],
            [
                'name' => 'Confirmed',
                'description' => 'Đặt bàn đã được xác nhận bởi nhân viên nhà hàng. Thông tin về đặt bàn đã được xác nhận và khách hàng đã nhận được thông báo xác nhận.',
            ],
            [
                'name' => 'Cancelled',
                'description' => 'Đặt bàn đã bị hủy bởi khách hàng hoặc nhân viên nhà hàng. Đặt bàn này không còn hiệu lực và không thể sử dụng.',
            ],
            [
                'name' => 'In Use',
                'description' => 'Đặt bàn đang được sử dụng bởi khách hàng. Khách hàng đã đến và đang ngồi tại bàn này.',
            ],
            [
                'name' => 'Completed',
                'description' => 'Đặt bàn đã hoàn thành. Khách hàng đã sử dụng bàn và hoàn thành bữa ăn hoặc dịch vụ tại nhà hàng.',
            ],
            [
                'name' => 'Pre-booked',
                'description' => 'Đặt bàn được tạo ra cho một thời điểm tương lai. Thông thường, đặt trước được sử dụng khi khách hàng muốn đặt bàn cho một sự kiện đặc biệt hoặc thời gian sắp tới.',
            ],
            [
                'name' => 'No-show',
                'description' => 'Đặt bàn đã được xác nhận nhưng khách hàng không xuất hiện và không thông báo trước. Điều này có thể dẫn đến hậu quả như phí không xuất hiện hoặc hạn chế đặt bàn trong tương lai.',
            ],
        ];

        foreach ($status_booking as $value) {
            DB::table('status_booking')->insert($value);
        }

        $categories_type = [
            [
                'name' => 'Món ăn',
                'description' => 'Danh sách các món ăn được cung cấp bởi nhà hàng.',
            ],
            [
                'name' => 'Đồ uống',
                'description' => 'Danh sách các loại đồ uống có sẵn trong nhà hàng.',
            ],
            [
                'name' => 'kho hàng',
                'description' => 'Danh sách các nguyên liệu và hàng hóa trong kho của nhà hàng.',
            ],
        ];

        foreach ($categories_type as $value) {
            DB::table('category_type')->insert($value);
        }

        $tables = [
            [
                'table_code' => null,
                'floor_id' =>  null,
                'area_id' => null,
                'status_id' => 1,
                'index_table' => 1,
                'total_user_sitting' => 6,
                'description' => '',
                'user_id' => 1,
            ],
            [
                'table_code' => null,
                'floor_id' =>  null,
                'area_id' => null,
                'status_id' => 1,
                'index_table' => 2,
                'total_user_sitting' => 6,
                'description' => '',
                'user_id' => 1,
            ],
            [
                'table_code' => null,
                'floor_id' =>  null,
                'area_id' => null,
                'status_id' => 1,
                'index_table' => 3,
                'total_user_sitting' => 6,
                'description' => '',
                'user_id' => 1,
            ],
            [
                'table_code' => null,
                'floor_id' =>  null,
                'area_id' => null,
                'status_id' => 1,
                'index_table' => 4,
                'total_user_sitting' => 6,
                'description' => '',
                'user_id' => 1,
            ],
            [
                'table_code' => null,
                'floor_id' =>  null,
                'area_id' => null,
                'status_id' => 1,
                'index_table' => 5,
                'total_user_sitting' => 6,
                'description' => '',
                'user_id' => 1,
            ],
            [
                'table_code' => null,
                'floor_id' =>  null,
                'area_id' => null,
                'status_id' => 1,
                'index_table' => 6,
                'total_user_sitting' => 6,
                'description' => '',
                'user_id' => 1,
            ],
            [
                'table_code' => null,
                'floor_id' =>  null,
                'area_id' => null,
                'status_id' => 1,
                'index_table' => 7,
                'total_user_sitting' => 6,
                'description' => '',
                'user_id' => 1,
            ],
            [
                'table_code' => null,
                'floor_id' =>  null,
                'area_id' => null,
                'status_id' => 1,
                'index_table' => 8,
                'total_user_sitting' => 6,
                'description' => '',
                'user_id' => 1,
            ],
            [
                'table_code' => null,
                'floor_id' =>  null,
                'area_id' => null,
                'status_id' => 1,
                'index_table' => 9,
                'total_user_sitting' => 6,
                'description' => '',
                'user_id' => 1,
            ],
            [
                'table_code' => null,
                'floor_id' =>  null,
                'area_id' => null,
                'status_id' => 1,
                'index_table' => 10,
                'total_user_sitting' => 6,
                'description' => '',
                'user_id' => 1,
            ],
            [
                'table_code' => null,
                'floor_id' =>  null,
                'area_id' => null,
                'status_id' => 1,
                'index_table' => 11,
                'total_user_sitting' => 6,
                'description' => '',
                'user_id' => 1,
            ],
            [
                'table_code' => null,
                'floor_id' =>  null,
                'area_id' => null,
                'status_id' => 1,
                'index_table' => 12,
                'total_user_sitting' => 6,
                'description' => '',
                'user_id' => 1,
            ],
            [
                'table_code' => null,
                'floor_id' =>  null,
                'area_id' => null,
                'status_id' => 1,
                'index_table' => 13,
                'total_user_sitting' => 6,
                'description' => '',
                'user_id' => 1,
            ],
            [
                'table_code' => null,
                'floor_id' =>  null,
                'area_id' => null,
                'status_id' => 1,
                'index_table' => 14,
                'total_user_sitting' => 6,
                'description' => '',
                'user_id' => 1,
            ],
            [
                'table_code' => null,
                'floor_id' =>  null,
                'area_id' => null,
                'status_id' => 1,
                'index_table' => 15,
                'total_user_sitting' => 6,
                'description' => '',
                'user_id' => 1,
            ],
            [
                'table_code' => null,
                'floor_id' =>  null,
                'area_id' => null,
                'status_id' => 1,
                'index_table' => 16,
                'total_user_sitting' => 6,
                'description' => '',
                'user_id' => 1,
            ],
            [
                'table_code' => null,
                'floor_id' =>  null,
                'area_id' => null,
                'status_id' => 1,
                'index_table' => 17,
                'total_user_sitting' => 6,
                'description' => '',
                'user_id' => 1,
            ],
            [
                'table_code' => null,
                'floor_id' =>  null,
                'area_id' => null,
                'status_id' => 1,
                'index_table' => 18,
                'total_user_sitting' => 6,
                'description' => '',
                'user_id' => 1,
            ],
            [
                'table_code' => null,
                'floor_id' =>  null,
                'area_id' => null,
                'status_id' => 1,
                'index_table' => 19,
                'total_user_sitting' => 6,
                'description' => '',
                'user_id' => 1,
            ],
            [
                'table_code' => null,
                'floor_id' =>  null,
                'area_id' => null,
                'status_id' => 1,
                'index_table' => 20,
                'total_user_sitting' => 6,
                'description' => '',
                'user_id' => 1,
            ],
        ];

        foreach ($tables as $value) {
            DB::table('tables')->insert($value);
        }
    }
}
