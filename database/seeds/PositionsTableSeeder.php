<?php

use Illuminate\Database\Seeder;
use App\Position;
class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $position_superuser= new Position();
        $position_superuser->name = 'Superuser';
        $position_superuser->description = '';
        $position_superuser->user_id = 1;
        $position_superuser->save();

        $position_admin= new Position();
        $position_admin->name = 'Administrator';
        $position_admin->description = '';
        $position_admin->user_id = 1;
        $position_admin->save();

        $position_acc= new Position();
        $position_acc->name = 'Accountant';
        $position_acc->description = '';
        $position_acc->user_id = 1;
        $position_acc->save();

        $position_stock= new Position();
        $position_stock->name = 'Stock';
        $position_stock->description = '';
        $position_stock->user_id = 1;
        $position_stock->save();

        $position_sale= new Position();
        $position_sale->name = 'Sale';
        $position_sale->description = '';
        $position_sale->user_id = 1;
        $position_sale->save();

        $position_sd= new Position();
        $position_sd->name = 'SD';
        $position_sd->description = '';
        $position_sd->user_id = 1;
        $position_sd->save();
    }
}
