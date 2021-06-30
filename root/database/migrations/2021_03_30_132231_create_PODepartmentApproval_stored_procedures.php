<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePODepartmentApprovalStoredProcedures extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = "SELECT
        pr_roles.id as role_id,
        pr_roles.name,
        pr_roles.min_amount,
        pr_roles.max_amount AS role_max_amount,
        pr_roles.zone,
        pr_roles.level,
        pr_roles.dep_id AS role_dep_id,
        ORDER_DEPARTMENT.id,
        ORDER_DEPARTMENT.pro_id,
        ORDER_DEPARTMENT.pr_id,
        ORDER_DEPARTMENT.dep_id,
        ORDER_DEPARTMENT.sup_id,
        ORDER_DEPARTMENT.ref_no,
        ORDER_DEPARTMENT.trans_date,
        ORDER_DEPARTMENT.delivery_date,
        ORDER_DEPARTMENT.delivery_address,
        ORDER_DEPARTMENT.trans_status,
        ORDER_DEPARTMENT.sub_total,
        ORDER_DEPARTMENT.disc_perc,
        ORDER_DEPARTMENT.disc_usd,
        ORDER_DEPARTMENT.grand_total,
        ORDER_DEPARTMENT.deposit,
        ORDER_DEPARTMENT.fee_charge,
        ORDER_DEPARTMENT.ordered_by_name AS ordered_by,
        ORDER_DEPARTMENT.note,
        ORDER_DEPARTMENT.term_pay,
        ORDER_DEPARTMENT.pr_no,
        ORDER_DEPARTMENT.warehouse,
        ORDER_DEPARTMENT.supplier,
        ORDER_DEPARTMENT.department,
        pr_user_assign_roles.id AS user_assign_id,
        pr_user_assign_roles.user_id AS user_assign_user_id,
        pr_user_assign_roles.role_id AS user_assign_role_id,
        ORDER_DEPARTMENT.created_at,
        DATEDIFF(
            NOW(), ORDER_DEPARTMENT.trans_date) AS day_ago
        FROM
            (
            SELECT
                pr_orders.*,
                pr_warehouses.name AS warehouse,
                pr_suppliers.name AS supplier,
                pr_system_datas.name AS department,
                pr_requests.ref_no AS pr_no,
                pr_users.name AS ordered_by_name,
                pr_roles.id AS role_id
            FROM
                pr_orders
            LEFT JOIN pr_users ON pr_users.id = pr_orders.ordered_by
            LEFT JOIN pr_roles ON pr_roles.dep_id = pr_orders.dep_id or	pr_roles.dep_id = pr_users.dep_id
            LEFT JOIN pr_warehouses ON pr_warehouses.id = pr_orders.delivery_address
            LEFT JOIN pr_suppliers ON pr_suppliers.id = pr_orders.sup_id
            LEFT JOIN pr_requests ON pr_requests.id = pr_orders.pr_id
            LEFT JOIN pr_system_datas ON pr_system_datas.id = pr_orders.dep_id
            WHERE
                pr_orders.pro_id = ProjectID AND pr_orders.trans_status IN(1, 2) AND pr_roles.zone = 2 AND pr_roles.level = 1
        ) AS ORDER_DEPARTMENT
    INNER JOIN pr_roles ON pr_roles.dep_id = ORDER_DEPARTMENT.role_id
    INNER JOIN `pr_user_assign_roles` ON `pr_user_assign_roles`.`role_id` = `pr_roles`.id
    LEFT JOIN pr_approve_orders ON pr_approve_orders.`role_id` = pr_roles.id AND pr_approve_orders.po_id = ORDER_DEPARTMENT.id AND pr_approve_orders.reject = 0
    WHERE
        pr_user_assign_roles.user_id = AuthID OR(
            AuthID IN(OWNER_USER, ADMIN) AND pr_roles.max_amount IN(
            SELECT
                MIN(pr_roles.max_amount) AS minimal
            FROM
                pr_roles
            WHERE
                pr_roles.zone = 2 AND pr_roles.level = 2
        )
        )
    GROUP BY
        pr_roles.id,
        ORDER_DEPARTMENT.id";
        \DB::unprepared("DROP PROCEDURE IF EXISTS PODepartmentApproval; CREATE PROCEDURE PODepartmentApproval(IN `ProjectID` INT, IN `AuthID` INT, IN `OWNER_USER` INT, IN `ADMIN` INT) BEGIN ({$sql}); END");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::unprepared("DROP PROCEDURE IF EXISTS PODepartmentApproval;");
    }
}
