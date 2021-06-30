<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrApprovalStoredProcedures extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = "SELECT 
        G.*,
        (SELECT 
          CONCAT(
            `pr_system_datas`.`desc`,
            ' (',
            `pr_system_datas`.`name`,
            ')'
          ) AS `name` 
        FROM
          `pr_system_datas` 
        WHERE `pr_system_datas`.`id` = G.dep_id) AS department,
        (SELECT 
          CONCAT(
            pr_constructors.`id_card`,
            ' (',
            pr_constructors.`name`,
            ')'
          ) AS `name` 
        FROM
          pr_constructors 
        WHERE pr_constructors.`id` = G.request_by) AS request_by 
      FROM
        (SELECT 
          T1.* 
        FROM
          (SELECT 
            PR.*,
            RO.role_id,
            RO.role_max_amount,
            DATEDIFF(NOW(), PR.created_at) AS day_ago 
          FROM
            (SELECT 
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
                pr_roles.`min_amount`,
                pr_roles.`max_amount`,
                pr_roles.`dep_id` 
              FROM
                `pr_roles` 
              WHERE pr_roles.`zone` = 1 
                AND pr_roles.`level` = 1) AS TOP 
              LEFT JOIN 
                (SELECT 
                  `pr_roles`.`id`,
                  pr_roles.`min_amount`,
                  pr_roles.`max_amount`,
                  pr_roles.`dep_id` 
                FROM
                  `pr_roles` 
                WHERE pr_roles.`zone` = 1 
                  AND pr_roles.`level` = 2) AS DEP 
                ON TOP.id = DEP.dep_id) AS RO 
            INNER JOIN 
              (SELECT 
                B.id,
                B.ref_no,
                B.trans_date,
                B.delivery_date,
                B.note,
                B.request_by,
                B.created_at,
                B.dep_id,
                SUM(B.amount) AS request_amount 
              FROM
                (SELECT 
                  A.*,
                  (
                    pr_request_items.`qty` * pr_request_items.`price`
                  ) AS amount 
                FROM
                  (SELECT 
                    pr_requests.`id`,
                    pr_requests.`ref_no`,
                    pr_requests.`trans_date`,
                    pr_requests.`delivery_date`,
                    pr_requests.`created_at`,
                    pr_requests.`request_by`,
                    pr_requests.`note`,
                    pr_requests.`dep_id` 
                  FROM
                    pr_requests 
                  WHERE pr_requests.`pro_id` = ProjectID 
                    AND pr_requests.`trans_status` IN (1, 2)) AS A 
                  INNER JOIN pr_request_items 
                    ON A.id = pr_request_items.`pr_id`) AS B 
              GROUP BY B.id) AS PR 
              ON (
                RO.dep_id = PR.dep_id 
                OR RO.dep_id = 0
              ) 
              AND (
                RO.role_min_amount <= PR.request_amount
              ) 
              AND RO.role_id NOT IN 
              (SELECT 
                pr_approve_requests.`role_id` 
              FROM
                `pr_approve_requests` 
              WHERE `pr_approve_requests`.`pr_id` = PR.id 
                AND `pr_approve_requests`.`role_id` = RO.role_id 
                AND `pr_approve_requests`.`reject` = 0)) AS T1 
          INNER JOIN 
            (SELECT 
              C.id,
              MIN(C.role_max_amount) AS role_max_amount_step 
            FROM
              (SELECT 
                PR.id,
                RO.role_max_amount 
              FROM
                (SELECT 
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
                    pr_roles.`min_amount`,
                    pr_roles.`max_amount`,
                    pr_roles.`dep_id` 
                  FROM
                    `pr_roles` 
                  WHERE pr_roles.`zone` = 1 
                    AND pr_roles.`level` = 1) AS TOP 
                  LEFT JOIN 
                    (SELECT 
                      `pr_roles`.`id`,
                      pr_roles.`min_amount`,
                      pr_roles.`max_amount`,
                      pr_roles.`dep_id` 
                    FROM
                      `pr_roles` 
                    WHERE pr_roles.`zone` = 1 
                      AND pr_roles.`level` = 2) AS DEP 
                    ON TOP.id = DEP.dep_id) AS RO 
                INNER JOIN 
                  (SELECT 
                    B.id,
                    B.dep_id,
                    SUM(B.amount) AS request_amount 
                  FROM
                    (SELECT 
                      A.*,
                      (
                        pr_request_items.`qty` * pr_request_items.`price`
                      ) AS amount 
                    FROM
                      (SELECT 
                        pr_requests.`id`,
                        pr_requests.`dep_id` 
                      FROM
                        pr_requests 
                      WHERE pr_requests.`pro_id` = ProjectID 
                        AND pr_requests.`trans_status` IN (1, 2)) AS A 
                      INNER JOIN pr_request_items 
                        ON A.id = pr_request_items.`pr_id`) AS B 
                  GROUP BY B.id) AS PR 
                  ON (
                    RO.dep_id = PR.dep_id 
                    OR RO.dep_id = 0
                  ) 
                  AND (
                    RO.role_min_amount <= PR.request_amount
                  ) 
                  AND RO.role_id NOT IN 
                  (SELECT 
                    pr_approve_requests.`role_id` 
                  FROM
                    `pr_approve_requests` 
                  WHERE `pr_approve_requests`.`pr_id` = PR.id 
                    AND `pr_approve_requests`.`role_id` = RO.role_id 
                    AND `pr_approve_requests`.`reject` = 0)) AS C 
            GROUP BY C.id) AS T2 
            ON T1.id = T2.id 
            AND T1.role_max_amount = T2.role_max_amount_step) AS G 
      WHERE AuthID IN (OWNER_USER, ADMIN) 
        OR AuthID IN 
        (SELECT 
          `pr_user_assign_roles`.`user_id` 
        FROM
          `pr_user_assign_roles` 
        WHERE `pr_user_assign_roles`.`role_id` = G.role_id)";
        \DB::unprepared("DROP PROCEDURE IF EXISTS PRApproval; CREATE PROCEDURE PRApproval(IN ProjectID int,IN AuthID int,IN OWNER_USER int,IN ADMIN int) BEGIN ({$sql}); END");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::unprepared("DROP PROCEDURE IF EXISTS PRApproval;");
    }
}
