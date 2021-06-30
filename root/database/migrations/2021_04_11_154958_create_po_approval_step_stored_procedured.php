<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoApprovalStepStoredProcedured extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = "SELECT 
        PO.id,
        RO.role_id,
        RO.name,
        RO.role_min_amount,
        RO.role_max_amount 
      FROM
        (SELECT 
        TOP.name,
          (
            CASE
              WHEN TOP.max_amount > 0 
              THEN TOP.id 
              ELSE DEP.id 
            END
          ) AS `role_id`,
          (
            CASE
              WHEN TOP.min_amount = 0 
              THEN DEP.min_amount 
              ELSE TOP.min_amount 
            END
          ) AS `role_min_amount`,
          (
            CASE
              WHEN TOP.max_amount = 0 
              THEN DEP.max_amount 
              ELSE TOP.max_amount 
            END
          ) AS `role_max_amount`,
          TOP.dep_id 
        FROM
          (SELECT 
            `pr_roles`.`id`,
            pr_roles.`name`,
            pr_roles.`min_amount`,
            pr_roles.`max_amount`,
            pr_roles.`dep_id` 
          FROM
            `pr_roles` 
          WHERE pr_roles.`zone` = 2 
            AND pr_roles.`level` = 1) AS TOP 
          LEFT JOIN 
            (SELECT 
              `pr_roles`.`id`,
              pr_roles.`name`,
              pr_roles.`min_amount`,
              pr_roles.`max_amount`,
              pr_roles.`dep_id` 
            FROM
              `pr_roles` 
            WHERE pr_roles.`zone` = 2 
              AND pr_roles.`level` = 2) AS DEP 
            ON TOP.id = DEP.dep_id) AS RO 
        INNER JOIN 
          (SELECT 
            pr_orders.`id`,
            pr_orders.`dep_id`,
            pr_orders.`grand_total` 
          FROM
            pr_orders 
          WHERE pr_orders.`pro_id` = ProjectID 
            AND pr_orders.`id` = OrderID) AS PO 
          ON (RO.dep_id = PO.dep_id OR RO.dep_id = 0) 
          AND (RO.role_min_amount <= PO.grand_total) ORDER BY RO.role_max_amount";
        \DB::unprepared("DROP PROCEDURE IF EXISTS POApprovalStep; CREATE PROCEDURE POApprovalStep(IN ProjectID int,IN OrderID int) BEGIN ({$sql}); END");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::unprepared("DROP PROCEDURE IF EXISTS POApprovalStep;");
    }
}
