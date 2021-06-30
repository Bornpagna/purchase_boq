<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCostingFifoStoredProcedures extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = "SELECT 
        b.id,
        b.ref_no AS code,
        b.trans_date,
        b.main_cost,
        b.warehouse_id,
        b.item_id,
        (
          CASE
            WHEN b.min_unit_to_code != '' 
            THEN b.min_unit_to_code 
            ELSE b.unit 
          END
        ) AS unit,
        (b.qty * b.unit_qty) AS qty,
        (b.cost / b.unit_qty) AS cost,
        b.type_ 
      FROM
        (SELECT 
          a.*,
          (
            CASE
              WHEN 
              (SELECT 
                `pr_units`.`factor` 
              FROM
                `pr_units` 
              WHERE pr_units.`from_code` = a.unit 
                AND pr_units.`to_code` = 
                (SELECT 
                  pr_items.`unit_stock` 
                FROM
                  pr_items 
                WHERE pr_items.`id` = a.item_id)) != '' 
              THEN 
              (SELECT 
                `pr_units`.`factor` 
              FROM
                `pr_units` 
              WHERE pr_units.`from_code` = a.unit 
                AND pr_units.`to_code` = 
                (SELECT 
                  pr_items.`unit_stock` 
                FROM
                  pr_items 
                WHERE pr_items.`id` = a.item_id)) 
              ELSE 1 
            END
          ) AS unit_qty,
          (SELECT 
            pr_units.`to_code` 
          FROM
            pr_units 
          WHERE pr_units.`from_code` = 
            (SELECT 
              pr_items.`unit_stock` 
            FROM
              pr_items 
            WHERE pr_items.`id` = a.item_id) 
            AND pr_units.`to_code` = 
            (SELECT 
              pr_units.`to_code` 
            FROM
              pr_units 
            WHERE pr_units.`from_code` = a.unit 
              AND pr_units.`factor` = 
              (SELECT 
                MIN(pr_units.`factor`) 
              FROM
                pr_units 
              WHERE pr_units.`from_code` = a.unit) 
            LIMIT 1)) AS min_unit_to_code 
        FROM
          (
              /*ENT*/
              SELECT 
              pr_stocks.ref_id as id,
              pr_stocks.ref_no,
          pr_stocks.trans_date,
            pr_stocks.amount AS main_cost,
            pr_stocks.`warehouse_id`,
            pr_stocks.`item_id`,
            pr_stocks.`unit`,
            pr_stocks.`qty`,
            pr_stocks.cost,
            'ENT' AS type_ 
            FROM pr_stocks 
              where pr_stocks.`ref_type` in('stock import','stock entry','return usage','stock delivery')
              AND pr_stocks.`pro_id` = PROJECT_ID 
              AND pr_stocks.`delete` = 0 
              AND pr_stocks.`item_id` = PRODUCT_ID  
              UNION ALL
          /*INV*/
          SELECT 
              pr_stocks.ref_id as id,
              pr_stocks.ref_no,
          pr_stocks.trans_date,
            pr_stocks.amount AS main_cost,
            pr_stocks.`warehouse_id`,
            pr_stocks.`item_id`,
            pr_stocks.`unit`,
            pr_stocks.`qty`,
            pr_stocks.cost,
            'INV' AS type_ 
            FROM pr_stocks 
              where pr_stocks.`ref_type` in('usage items','return delivery')
              AND pr_stocks.`pro_id` = PROJECT_ID 
              AND pr_stocks.`delete` = 0 
              AND pr_stocks.`item_id` = PRODUCT_ID  
              UNION ALL 
          /*Stock Adjust*/
          SELECT 
            sad.id,
            sad.ref_no,
            sad.trans_date,
            sad.total_cost AS main_cost,
            st.`warehouse_id`,
            st.`item_id`,
            st.`unit`,
            st.`adjust_qty`,
            st.total_cost AS cost,
            'ADJ' AS type_ 
          FROM
            pr_stock_adjusts AS sad 
            INNER JOIN `pr_stock_adjust_details` AS st 
              ON st.`adjust_id` = sad.`id` 
              AND sad.`pro_id` = PROJECT_ID 
              AND sad.`delete` = 0 
              AND st.`item_id` = PRODUCT_ID) AS a) AS b ORDER BY b.trans_date ASC";
        \DB::unprepared("DROP PROCEDURE IF EXISTS COSTING_FIFO; CREATE PROCEDURE COSTING_FIFO(IN PROJECT_ID int,IN PRODUCT_ID int) BEGIN ({$sql}); END");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::unprepared("DROP PROCEDURE IF EXISTS COSTING_FIFO;");
    }
}
