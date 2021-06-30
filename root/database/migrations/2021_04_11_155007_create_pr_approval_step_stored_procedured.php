<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrApprovalStepStoredProcedured extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = "SELECT PR.id, RO.role_id, RO.name, RO.role_min_amount, RO.role_max_amount FROM (SELECT TOP.name, (CASE WHEN TOP.max_amount > 0 THEN TOP.id ELSE DEP.id END ) AS `role_id`, (CASE WHEN TOP.min_amount = 0 THEN DEP.min_amount ELSE TOP.min_amount END ) AS `role_min_amount`, (CASE WHEN TOP.max_amount = 0 THEN DEP.max_amount ELSE TOP.max_amount END ) AS `role_max_amount`, TOP.dep_id FROM (SELECT `pr_roles`.`id`, pr_roles.`name`, pr_roles.`min_amount`, pr_roles.`max_amount`, pr_roles.`dep_id` FROM `pr_roles` WHERE pr_roles.`zone` = 1 AND pr_roles.`level` = 1) AS TOP LEFT JOIN (SELECT `pr_roles`.`id`, pr_roles.`name`, pr_roles.`min_amount`, pr_roles.`max_amount`, pr_roles.`dep_id` FROM `pr_roles` WHERE pr_roles.`zone` = 1 AND pr_roles.`level` = 2) AS DEP ON TOP.id = DEP.dep_id) AS RO INNER JOIN (SELECT B.id, B.dep_id, SUM(B.amount) AS request_amount FROM (SELECT A.*,(pr_request_items.`qty` * pr_request_items.`price`) AS amount FROM (SELECT pr_requests.`id`, pr_requests.`dep_id` FROM pr_requests WHERE pr_requests.`pro_id` = ProjectID AND pr_requests.`id` = PurchaseID) AS A INNER JOIN pr_request_items ON A.id = pr_request_items.`pr_id`) AS B GROUP BY B.id) AS PR ON (RO.dep_id = PR.dep_id OR RO.dep_id = 0) AND (RO.role_min_amount <= PR.request_amount) ORDER BY RO.role_max_amount";
        \DB::unprepared("DROP PROCEDURE IF EXISTS PRApprovalStep; CREATE PROCEDURE PRApprovalStep(IN ProjectID int,IN PurchaseID int) BEGIN ({$sql}); END");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::unprepared("DROP PROCEDURE IF EXISTS PRApprovalStep;");
    }
}
