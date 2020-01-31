<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class CategoriesUnitsItemTypesSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $categories = self::getCategory();
    DB::table('categories')->insert($categories);

    $units = self::getUnit();
    DB::table('units')->insert($units);


    DB::table('item_types')->insert([
      'id' => 1,
      'description' => "Raw",
      'created_at' => Carbon::now(),
    ]);

    DB::table('item_types')->insert([
      'id' => 2,
      'description' => "Product",
      'created_at' => Carbon::now(),
    ]);

    DB::table('item_types')->insert([
      'id' => 3,
      'description' => "Other",
      'created_at' => Carbon::now(),
    ]);

    DB::table('items')->insert([
      'description' => "BEEF",
      'unit_id' => 4,
      'category_id' => 2,
      'item_type_id' => 1,
      'user_id' => 1,
      'created_at' => Carbon::now(),
    ]);

    DB::table('raws')->insert([
      'value' => 1000,
      'item_id' => 1,
      'created_at' => Carbon::now(),
    ]);

    DB::table('items')->insert([
      'description' => "PORK",
      'unit_id' => 4,
      'category_id' => 2,
      'item_type_id' => 1,
      'user_id' => 1,
      'created_at' => Carbon::now(),
    ]);

    DB::table('raws')->insert([
      'value' => 1000,
      'item_id' => 2,
      'created_at' => Carbon::now(),
    ]);


    DB::table('items')->insert([
      'description' => "PORK (80 Grams)",
      'unit_id' => 1,
      'category_id' => 2,
      'item_type_id' => 2,
      'user_id' => 2,
      'created_at' => Carbon::now(),
    ]);

    DB::table('raw_products')->insert([
      'value' => 80,
      'item_id' => 3,
      'raw_id' => 2,
      'created_at' => Carbon::now(),
    ]);

    DB::table('items')->insert([
      'description' => "PORK (40 Grams)",
      'unit_id' => 1,
      'category_id' => 2,
      'item_type_id' => 2,
      'user_id' => 2,
      'created_at' => Carbon::now(),
    ]);

    DB::table('raw_products')->insert([
      'value' => 40,
      'item_id' => 4,
      'raw_id' => 2,
      'created_at' => Carbon::now(),
    ]);


    DB::table('items')->insert([
      'description' => "Dish Washing Liquid",
      'unit_id' => 1,
      'category_id' => 7,
      'item_type_id' => 3,
      'user_id' => 2,
      'created_at' => Carbon::now(),
    ]);

    DB::table('not_raws')->insert([
      'item_id' => 5,
      'created_at' => Carbon::now(),
    ]);
  }
  private function getCategory()
  {
    $created = Carbon::now();
    return array(
      // array('id' => '1','description' => 'Seafoods','created_at' => 'Afghanistan','created_at'  => date('Y-m-d H:i:s'),'updated_at'  => date('Y-m-d H:i:s')),
      array('id' => '1', 'description' => 'Seafoods', 'created_at' => $created),
      array('id' => '2', 'description' => 'Meats', 'created_at' => $created),
      array('id' => '3', 'description' => 'Fresh', 'created_at' => $created),
      array('id' => '4', 'description' => 'Dry Goods', 'created_at' => $created),
      array('id' => '5', 'description' => 'Tea', 'created_at' => $created),
      array('id' => '6', 'description' => 'Souces', 'created_at' => $created),
      array('id' => '7', 'description' => 'Others', 'created_at' => $created),
    );
  }

  private function getUnit()
  {
    $created = Carbon::now();
    return array(
      // array('id' => '1','description' => 'Seafoods','created_at' => 'Afghanistan','created_at'  => date('Y-m-d H:i:s'),'updated_at'  => date('Y-m-d H:i:s')),
      array('id' => '1', 'description' => 'Pack', 'created_at' => $created),
      array('id' => '2', 'description' => 'Tab', 'created_at' => $created),
      array('id' => '3', 'description' => 'Roll', 'created_at' => $created),
      array('id' => '4', 'description' => 'Kilo', 'created_at' => $created),
      array('id' => '5', 'description' => 'Liter', 'created_at' => $created),
      array('id' => '6', 'description' => 'Bottle', 'created_at' => $created),
      array('id' => '7', 'description' => 'Box', 'created_at' => $created),
      array('id' => '8', 'description' => 'Bar', 'created_at' => $created),
      array('id' => '9', 'description' => 'Tray', 'created_at' => $created),
    );
  }
}
