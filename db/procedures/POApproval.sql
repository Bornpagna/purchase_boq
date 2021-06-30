DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `POApproval`(IN `ProjectID` INT, IN `AuthID` INT, IN `OWNER_USER` INT, IN `ADMIN` INT)
BEGIN
  (SELECT 
    G.*,
    (SELECT 
      pr_requests.`ref_no` 
    FROM
      pr_requests 
    WHERE pr_requests.`id` = G.pr_id) AS pr_no,
    (SELECT 
      CONCAT(
        pr_warehouses.`address`,
        ' (',
        pr_warehouses.`name`,
        ')'
      ) AS `name` 
    FROM
      pr_warehouses 
    WHERE pr_warehouses.`id` = G.delivery_address) AS warehouse,
    (SELECT 
      CONCAT(
        pr_suppliers.`desc`,
        ' (',
        `pr_suppliers`.`name`,
        ')'
      ) AS `name` 
    FROM
      pr_suppliers 
    WHERE pr_suppliers.`id` = G.sup_id) AS supplier,
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
      pr_users.`name` 
    FROM
      pr_users 
    WHERE pr_users.`id` = G.ordered_by) AS ordered_by 
  FROM
    (SELECT 
      T1.* 
    FROM
      (SELECT 
        PO.*,
        RO.role_id,
        RO.role_max_amount,
        DATEDIFF(NOW(), PO.created_at) AS day_ago  
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
          WHERE pr_roles.`zone` = 2 
            AND pr_roles.`level` = 1) AS TOP 
          LEFT JOIN 
            (SELECT 
              `pr_roles`.`id`,
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
            pr_orders.`pr_id`,
            pr_orders.`sup_id`,
            pr_orders.`ref_no`,
            pr_orders.`trans_date`,
            pr_orders.`delivery_date`,
            pr_orders.`delivery_address`,
            pr_orders.`created_at`,
            pr_orders.`sub_total`,
            pr_orders.`disc_usd`,
            pr_orders.`grand_total`,
            pr_orders.`ordered_by`,
            pr_orders.`term_pay`,
            pr_orders.`note` 
          FROM
            pr_orders 
          WHERE pr_orders.`pro_id` = ProjectID 
            AND pr_orders.`trans_status` IN (1, 2)) AS PO 
          ON (
            RO.dep_id = PO.dep_id 
            OR RO.dep_id = 0
          ) 
          AND (
            RO.role_min_amount <= PO.grand_total
          ) 
          AND RO.role_id NOT IN 
          (SELECT 
            pr_approve_orders.`role_id` 
          FROM
            `pr_approve_orders` 
          WHERE `pr_approve_orders`.`po_id` = PO.id 
            AND `pr_approve_orders`.`role_id` = RO.role_id)) AS T1 
      INNER JOIN 
        (SELECT 
          C.id,
          MIN(C.role_max_amount) AS role_max_amount_step 
        FROM
          (SELECT 
            PO.id,
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
              WHERE pr_roles.`zone` = 2 
                AND pr_roles.`level` = 1) AS TOP 
              LEFT JOIN 
                (SELECT 
                  `pr_roles`.`id`,
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
                AND pr_orders.`trans_status` IN (1, 2)) AS PO 
              ON (
                RO.dep_id = PO.dep_id 
                OR RO.dep_id = 0
              ) 
              AND (
                RO.role_min_amount <= PO.grand_total
              ) 
              AND RO.role_id NOT IN 
              (SELECT 
                pr_approve_orders.`role_id` 
              FROM
                `pr_approve_orders` 
              WHERE `pr_approve_orders`.`po_id` = PO.id 
                AND `pr_approve_orders`.`role_id` = RO.role_id)) AS C 
        GROUP BY C.id) AS T2 
        ON T1.id = T2.id 
        AND T1.role_max_amount = T2.role_max_amount_step) AS G 
  WHERE AuthID IN (OWNER_USER, ADMIN) 
    OR AuthID IN 
    (SELECT 
      `pr_user_assign_roles`.`user_id` 
    FROM
      `pr_user_assign_roles` 
    WHERE `pr_user_assign_roles`.`role_id` = G.role_id)) ;
END$$
DELIMITER ;