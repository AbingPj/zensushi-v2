<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsDisplayView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("


      CREATE VIEW items_views AS
      (

                    SELECT items.id AS id,
                            items.description AS description,
                        units.description AS unit,      
                        categories.description AS category,
                        item_types.description AS item_type,
                        items.created_at,
                        items.user_id,
                        items.category_id,
                        items.item_type_id,
                        items.unit_id,
                        ITEM_IN.IN,
                        ITEM_OUT.OUT,

                        IFNULL((ITEM_IN.IN - IFNULL(ITEM_OUT.OUT,0) ),'0') as 'balance'
                        
                    FROM items
                    INNER JOIN categories ON categories.id = items.category_id
                    INNER JOIN units ON units.id = items.unit_id
                    INNER JOIN item_types ON item_types.id = items.item_type_id
                  
                    LEFT JOIN 
                    (     SELECT item_id, SUM(value) as 'IN' 
                            FROM `in_records` 
                            GROUP BY item_id      )
                    as ITEM_IN ON ITEM_IN.item_id = items.id

                    LEFT JOIN 
                    (		SELECT item_id, SUM(value) as 'OUT'
                                FROM `out_records`
                                GROUP BY item_id ) 
                    as ITEM_OUT ON ITEM_OUT.item_id = items.id
       
      )



    ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS items_views');
    }
}
