<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePOTopLevelApprovalStoredProcedures extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = "SELECT
        pr_roles.id AS role_id,
        pr_roles.name,
        pr_roles.min_amount,
        pr_roles.max_amount AS role_max_amount,
        pr_roles.zone,
        pr_roles.level,
        pr_roles.dep_id AS role_dep_id,
        pr_orders.id,
        pr_orders.pro_id,
        pr_orders.pr_id,
        pr_orders.dep_id,
        pr_orders.sup_id,
        pr_orders.ref_no,
        pr_orders.trans_date,
        pr_orders.delivery_date,
        pr_orders.delivery_address,
        pr_orders.trans_status,
        pr_orders.sub_total,
        pr_orders.disc_perc,
        pr_orders.disc_usd,
        pr_orders.grand_total,
        pr_orders.deposit,
        pr_orders.fee_charge,
        pr_users.name AS ordered_by,
        pr_orders.note,
        pr_orders.term_pay,
        pr_requests.ref_no AS pr_no,
        pr_warehouses.name AS warehouse,
        pr_suppliers.name AS supplier,
        pr_system_datas.name AS department,
        pr_user_assign_roles.id AS user_assign_id,
        pr_user_assign_roles.user_id AS user_assign_user_id,
        pr_user_assign_roles.role_id AS user_assign_role_id,
        pr_orders.created_at,
        DATEDIFF(NOW(), pr_orders.trans_date) AS day_ago
    FROM
        pr_orders
    INNER JOIN pr_roles ON pr_roles.zone = 2 AND pr_roles.level = 1 AND pr_roles.dep_id = 0
    INNER JOIN pr_user_assign_roles ON pr_user_assign_roles.role_id = pr_roles.id
    INNER JOIN pr_approve_orders ON pr_approve_orders.`role_id` = pr_roles.id AND pr_approve_orders.po_id = pr_orders.id AND pr_approve_orders.reject = 0
    LEFT JOIN pr_warehouses ON pr_warehouses.id = pr_orders.delivery_address
    LEFT JOIN pr_suppliers ON pr_suppliers.id = pr_orders.sup_id
    LEFT JOIN pr_users ON pr_users.id = pr_orders.ordered_by
    LEFT JOIN pr_requests ON pr_requests.id = pr_orders.pr_id
    LEFT JOIN pr_system_datas ON pr_system_datas.id = pr_orders.dep_id
    WHERE
        pr_orders.pro_id = ProjectID AND pr_orders.trans_status IN(1, 2) AND pr_orders.grand_total BETWEEN pr_roles.min_amount AND pr_roles.max_amount AND pr_user_assign_roles.user_id = AuthID OR AuthID IN(OWNER_USER, ADMIN)";
        \DB::unprepared("DROP PROCEDURE IF EXISTS POTopLevelApproval; CREATE PROCEDURE POTopLevelApproval(IN `ProjectID` INT, IN `AuthID` INT, IN `OWNER_USER` INT, IN `ADMIN` INT) BEGIN ({$sql}); END");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::unprepared("DROP PROCEDURE IF EXISTS POTopLevelApproval;");
    }
}
