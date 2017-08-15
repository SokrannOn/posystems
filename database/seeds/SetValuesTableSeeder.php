<?php

use Illuminate\Database\Seeder;
use App\SetValue;

class SetValuesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //---------------SD----------------
        $codsd= new SetValue();
        $codsd->name = 'COD របស់ SD';
        $codsd->value = 20;
        $codsd->status = 1;
        $codsd->description = '';
        $codsd->user_id = 1;
        $codsd->save();

        $discountsd1= new SetValue();
        $discountsd1->name = 'បញ្ចុះតម្លៃជា%តាមលក្ខ័ណ្ឌទី១របស់SD';
        $discountsd1->value = 10;
        $discountsd1->status = 1;
        $discountsd1->description = '';
        $discountsd1->user_id = 1;
        $discountsd1->save();

        $discountsd2= new SetValue();
        $discountsd2->name = 'បញ្ចុះតម្លៃជា%តាមលក្ខ័ណ្ឌទី២របស់SD';
        $discountsd2->value = 15;
        $discountsd2->status = 1;
        $discountsd2->description = '';
        $discountsd2->user_id = 1;
        $discountsd2->save();

        $conditionsd1= new SetValue();
        $conditionsd1->name = 'លក្ខ័ណ្ឌទី១របស់SD';
        $conditionsd1->value = 50;
        $conditionsd1->status = 1;
        $conditionsd1->description = '';
        $conditionsd1->user_id = 1;
        $conditionsd1->save();

        $conditionsd2= new SetValue();
        $conditionsd2->name = 'លក្ខ័ណ្ឌទី២របស់SD';
        $conditionsd2->value = 150;
        $conditionsd2->status = 1;
        $conditionsd2->description = '';
        $conditionsd2->user_id = 1;
        $conditionsd2->save();

        //----------------Customer--------------
        $codcus= new SetValue();
        $codcus->name = 'COD របស់ Customer';
        $codcus->value = 5;
        $codcus->status = 1;
        $codcus->description = '';
        $codcus->user_id = 1;
        $codcus->save();

        $discountcus1= new SetValue();
        $discountcus1->name = 'បញ្ចុះតម្លៃជា%តាមលក្ខ័ណ្ឌទី១របស់Customer';
        $discountcus1->value = 10;
        $discountcus1->status = 0;
        $discountcus1->description = '';
        $discountcus1->user_id = 1;
        $discountcus1->save();

        $discountcus2= new SetValue();
        $discountcus2->name = 'បញ្ចុះតម្លៃជា%តាមលក្ខ័ណ្ឌទី២របស់Customer';
        $discountcus2->value = 15;
        $discountcus2->status = 0;
        $discountcus2->description = '';
        $discountcus2->user_id = 1;
        $discountcus2->save();

        $conditioncus1= new SetValue();
        $conditioncus1->name = 'លក្ខ័ណ្ឌទី១របស់Customer';
        $conditioncus1->value = 50;
        $conditioncus1->status = 1;
        $conditioncus1->description = '';
        $conditioncus1->user_id = 1;
        $conditioncus1->save();

        $conditioncus2= new SetValue();
        $conditioncus2->name = 'លក្ខ័ណ្ឌទី២របស់Customer';
        $conditioncus2->value = 150;
        $conditioncus2->status = 0;
        $conditioncus2->description = '';
        $conditioncus2->user_id = 1;
        $conditioncus2->save();

        $vat= new SetValue();
        $vat->name = 'អាករលើតម្លៃបន្ថែម%';
        $vat->value = 10;
        $vat->status = 0;
        $vat->description = '';
        $vat->user_id = 1;
        $vat->save();
    }
}
