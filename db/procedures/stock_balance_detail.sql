DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `stock_balance_detail`(IN `pro_` INT, IN `warehouse_` VARCHAR(100), IN `start_` VARCHAR(100), IN `end_` VARCHAR(100), IN `item_` INT)
BEGIN
  (SELECT 
    C.id,
    C.ref_no,
    C.ref_type,
    C.item_id,
    (SELECT 
      `pr_items`.`code` 
    FROM
      `pr_items` 
    WHERE `pr_items`.`id` = C.item_id) AS item_code,
    (SELECT 
      `pr_items`.`name` 
    FROM
      pr_items 
    WHERE `pr_items`.`id` = C.item_id) AS item_name,
    C.cat_id,
    (SELECT 
      `pr_system_datas`.`name` 
    FROM
      `pr_system_datas` 
    WHERE `pr_system_datas`.`id` = C.cat_id) AS category,
    (SELECT 
      `pr_system_datas`.`desc` 
    FROM
      `pr_system_datas` 
    WHERE `pr_system_datas`.`id` = C.cat_id) AS category_desc,
    SUM(C.qty) AS qty,
    C.unit_stock,
    C.unit,
    C.warehouse_id,
    (SELECT `pr_users`.`name` FROM `pr_users` WHERE `pr_users`.`id`=C.created_by)AS created_by,
    (SELECT 
      `pr_warehouses`.`name` 
    FROM
      `pr_warehouses` 
    WHERE `pr_warehouses`.`id` = C.warehouse_id) AS warehouse,
    C.trans_date,
    C.trans_ref,
    C.date_compare 
  FROM
    (SELECT 
      B.id,
      B.ref_no,
      B.ref_type,
      B.item_id,
      B.cat_id,
      B.unit_stock,
      B.unit,
      (B.qty * B.factor) AS qty,
      B.warehouse_id,
      B.created_by,
      B.trans_date,
      B.trans_ref,
      B.date_compare 
    FROM
      (SELECT 
        A.*,
        (SELECT 
          `pr_units`.`factor` 
        FROM
          `pr_units` 
        WHERE `pr_units`.`from_code` = A.unit 
          AND `pr_units`.`to_code` = A.unit_stock) AS factor 
      FROM
        (SELECT 
          st.`id`,
          st.`ref_no`,
          st.`ref_type`,
          st.`item_id`,
          (SELECT 
            `pr_items`.`cat_id` 
          FROM
            `pr_items` 
          WHERE `pr_items`.`id` = st.item_id) AS cat_id,
          (SELECT 
            `pr_items`.`unit_stock` 
          FROM
            `pr_items` 
          WHERE `pr_items`.`id` = st.`item_id`) AS unit_stock,
          st.qty,
          st.`unit`,
          st.`warehouse_id`,
          st.created_by,
          st.`trans_date`,
          st.trans_ref,
          (
            CASE
              WHEN st.trans_date > 
              (SELECT 
                DATE_SUB(start_, INTERVAL 1 DAY)) 
              THEN st.trans_date 
              ELSE 
              (SELECT 
                DATE_SUB(start_, INTERVAL 1 DAY)) 
            END
          ) AS date_compare 
        FROM
          `pr_stocks` AS st 
        WHERE st.`pro_id` = pro_ 
          AND st.warehouse_id IN (warehouse_) 
          AND st.`trans_date` <= end_ 
          AND st.item_id = item_ 
          AND st.`delete` = 0) AS A) AS B) AS C 
  WHERE C.date_compare = 
    (SELECT 
      DATE_SUB(start_, INTERVAL 1 DAY)) 
  GROUP BY C.warehouse_id,
    C.item_id) 
  UNION
  ALL 
  (SELECT 
    C.id,
    C.ref_no,
    C.ref_type,
    C.item_id,
    (SELECT 
      `pr_items`.`code` 
    FROM
      `pr_items` 
    WHERE `pr_items`.`id` = C.item_id) AS item_code,
    (SELECT 
      `pr_items`.`name` 
    FROM
      pr_items 
    WHERE `pr_items`.`id` = C.item_id) AS item_name,
    C.cat_id,
    (SELECT 
      `pr_system_datas`.`name` 
    FROM
      `pr_system_datas` 
    WHERE `pr_system_datas`.`id` = C.cat_id) AS category,
    (SELECT 
      `pr_system_datas`.`desc` 
    FROM
      `pr_system_datas` 
    WHERE `pr_system_datas`.`id` = C.cat_id) AS category_desc,
    SUM(C.qty) AS qty,
    C.unit_stock,
    C.unit,
    C.warehouse_id,
    (SELECT `pr_users`.`name` FROM `pr_users` WHERE `pr_users`.`id`=C.created_by)AS created_by,
    (SELECT 
      `pr_warehouses`.`name` 
    FROM
      `pr_warehouses` 
    WHERE `pr_warehouses`.`id` = C.warehouse_id) AS warehouse,
    C.trans_date,
    C.trans_ref,
    C.date_compare 
  FROM
    (SELECT 
      B.id,
      B.ref_no,
      B.ref_type,
      B.item_id,
      B.cat_id,
      B.unit_stock,
      B.unit,
      (B.qty * B.factor) AS qty,
      B.warehouse_id,
      B.created_by,
      B.trans_date,
      B.trans_ref,
      B.date_compare 
    FROM
      (SELECT 
        A.*,
        (SELECT 
          `pr_units`.`factor` 
        FROM
          `pr_units` 
        WHERE `pr_units`.`from_code` = A.unit 
          AND `pr_units`.`to_code` = A.unit_stock) AS factor 
      FROM
        (SELECT 
          st.`id`,
          st.`ref_no`,
          st.`ref_type`,
          st.`item_id`,
          (SELECT 
            `pr_items`.`cat_id` 
          FROM
            `pr_items` 
          WHERE `pr_items`.`id` = st.item_id) AS cat_id,
          (SELECT 
            `pr_items`.`unit_stock` 
          FROM
            `pr_items` 
          WHERE `pr_items`.`id` = st.`item_id`) AS unit_stock,
          st.qty,
          st.`unit`,
          st.`warehouse_id`,
          st.created_by,
          st.`trans_date`,
          st.trans_ref,
          (
            CASE
              WHEN st.trans_date > 
              (SELECT 
                DATE_SUB(start_, INTERVAL 1 DAY)) 
              THEN st.trans_date 
              ELSE 
              (SELECT 
                DATE_SUB(start_, INTERVAL 1 DAY)) 
            END
          ) AS date_compare 
        FROM
          `pr_stocks` AS st 
        WHERE st.`pro_id` = pro_ 
          AND st.warehouse_id IN (warehouse_) 
          AND st.`trans_date` <= end_ 
          AND st.item_id = item_ 
          AND st.`delete` = 0) AS A) AS B) AS C 
  WHERE C.date_compare != 
    (SELECT 
      DATE_SUB(start_, INTERVAL 1 DAY)) 
  GROUP BY C.id) ;
END$$
DELIMITER ;