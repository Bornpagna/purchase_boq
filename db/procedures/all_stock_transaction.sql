DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `all_stock_transaction`(IN `pro_` INT, IN `warehouse_` VARCHAR(100), IN `start_` VARCHAR(100), IN `end_` VARCHAR(100), IN `type_` INT)
BEGIN
	IF type_=0
	THEN
	(SELECT * FROM(SELECT * FROM(SELECT 
  ud.id,
  ud.`use_id`,
  ud.`warehouse_id`,
  (SELECT `pr_warehouses`.`name` FROM `pr_warehouses` WHERE `pr_warehouses`.`id`=ud.`warehouse_id`)AS warehouse,
  ud.`item_id`,
  (SELECT `pr_items`.`code` FROM `pr_items` WHERE `pr_items`.`id`=ud.item_id)AS item_code,
  (SELECT `pr_items`.`name` FROM `pr_items` WHERE `pr_items`.`id`=ud.item_id)AS item_name,
  ud.`qty`,
  (SELECT `pr_units`.`from_desc` FROM `pr_units` WHERE `pr_units`.`from_code`=ud.unit LIMIT 1)AS unit,
  ud.`created_by`,
  (SELECT `pr_users`.`name` FROM `pr_users` WHERE `pr_users`.`id`=ud.`created_by`)AS created_name,
  u.`trans_date`,
  u.`ref_no`,
  u.`pro_id`,
  (SELECT `pr_projects`.`name` FROM `pr_projects` WHERE `pr_projects`.`id`=u.`pro_id`)AS project,
  'Usage' AS type_,
  5 AS type_no 
FROM
  `pr_usage_details` AS ud 
  INNER JOIN `pr_usages` AS u 
    ON ud.`use_id` = u.id 
    AND u.`pro_id` = pro_ 
    AND ud.`warehouse_id` IN (warehouse_) 
    AND u.`trans_date` BETWEEN start_ 
    AND end_ 
    AND ud.`delete` = 0 )AS A
UNION ALL
SELECT * FROM(SELECT 
  di.`id`,
  di.`del_id`,
  di.`warehouse_id`,
  (SELECT `pr_warehouses`.`name` FROM `pr_warehouses` WHERE `pr_warehouses`.`id`=di.warehouse_id) AS warehouse,
  di.item_id,
  (SELECT `pr_items`.`code` FROM `pr_items` WHERE `pr_items`.`id`=di.item_id) AS item_code,
  (SELECT `pr_items`.`name` FROM `pr_items` WHERE `pr_items`.`id`=di.item_id) AS item_name,
  di.qty,
  (SELECT `pr_units`.`from_desc` FROM `pr_units` WHERE `pr_units`.`from_code`=di.unit LIMIT 1) AS unit,
  d.created_by,
  (SELECT `pr_users`.`name` FROM `pr_users` WHERE `pr_users`.`id`=d.created_by) AS created_name,
  d.trans_date,
  d.ref_no,
  d.pro_id,
  (SELECT `pr_projects`.`name` FROM `pr_projects` WHERE `pr_projects`.`id`=d.`pro_id`) AS project,
  'Delivery' AS type_,
  7 AS type_no 
FROM
  `pr_delivery_items` AS di 
  INNER JOIN `pr_deliveries` AS d 
  ON di.`del_id`=d.`id`
  AND d.`pro_id`=pro_
  AND di.`warehouse_id` IN(warehouse_)
  AND d.`trans_date` BETWEEN start_ AND end_
  AND d.`delete`=0)AS B
UNION ALL
SELECT * FROM(SELECT 
  rdi.`id`,
  rdi.`return_id`,
  rdi.`warehouse_id`,
  (SELECT `pr_warehouses`.`name` FROM `pr_warehouses` WHERE `pr_warehouses`.`id`=rdi.warehouse_id) AS warehouse,
  rdi.item_id,
  (SELECT `pr_items`.`code` FROM `pr_items` WHERE `pr_items`.`id`=rdi.item_id) AS item_code,
  (SELECT `pr_items`.`name` FROM `pr_items` WHERE `pr_items`.`id`=rdi.item_id) AS item_name,
  rdi.qty,
  (SELECT `pr_units`.`from_desc` FROM `pr_units` WHERE `pr_units`.`from_code`=rdi.unit LIMIT 1) AS unit,
  rd.created_by,
  (SELECT `pr_users`.`name` FROM `pr_users` WHERE `pr_users`.`id`=rd.created_by) AS created_name,
  rd.trans_date,
  rd.ref_no,
  rd.pro_id,
  (SELECT `pr_projects`.`name` FROM `pr_projects` WHERE `pr_projects`.`id`=rd.`pro_id`)AS project,
  'Return Delivery' AS type_,
  8 AS type_no 
FROM
  `pr_return_delivery_items` AS rdi 
  INNER JOIN `pr_return_deliveries` AS rd 
  ON rdi.`return_id`=rd.`id`
  AND rd.`pro_id`=pro_
  AND rd.`delete`=0
  AND rd.`trans_date` BETWEEN start_ AND end_
  AND rdi.`warehouse_id` IN(warehouse_))AS C
UNION ALL
SELECT * FROM(SELECT 
  rud.`id`,
  rud.`return_id`,
  rud.`warehouse_id`,
  (SELECT `pr_warehouses`.`name` FROM `pr_warehouses` WHERE `pr_warehouses`.`id`=rud.warehouse_id)AS warehouse,
  rud.`item_id`,
  (SELECT `pr_items`.`code` FROM `pr_items` WHERE `pr_items`.`id`=rud.item_id)AS item_code,
  (SELECT `pr_items`.`name` FROM `pr_items` WHERE `pr_items`.`id`=rud.item_id)AS item_name,
  rud.`qty`,
  (SELECT `pr_units`.`from_desc` FROM `pr_units` WHERE `pr_units`.`from_code`=rud.unit LIMIT 1)AS unit,
  ru.`created_by`,
  (SELECT `pr_users`.`name` FROM `pr_users` WHERE `pr_users`.`id`=ru.created_by)AS created_name,
  ru.`trans_date`,
  ru.`ref_no`,
  ru.`pro_id`,
  (SELECT `pr_projects`.`name` FROM `pr_projects` WHERE `pr_projects`.`id`=ru.`pro_id`)AS project,
  'Return Usage' AS type_,
  6 AS type_no  
FROM
  `pr_return_usage_details` AS rud 
  INNER JOIN `pr_return_usages` AS ru )AS D
UNION ALL
SELECT * FROM(SELECT 
  sad.`id`,
  sad.`adjust_id`,
  sad.`warehouse_id`,
  (SELECT `pr_warehouses`.`name` FROM `pr_warehouses` WHERE `pr_warehouses`.`id`=sad.warehouse_id)AS warehouse,
  sad.`item_id`,
  (SELECT `pr_items`.`code` FROM `pr_items` WHERE `pr_items`.`id`=sad.item_id)AS item_code,
  (SELECT `pr_items`.`name` FROM `pr_items` WHERE `pr_items`.`id`=sad.item_id)AS item_name,
  sad.`adjust_qty`,
  sad.`unit`,
  sad.`created_by`,
  (SELECT `pr_users`.`name` FROM `pr_users` WHERE `pr_users`.`id`=sad.created_by)AS created_name,
  sa.`trans_date`,
  sa.`ref_no`,
  sa.`pro_id`,
  (SELECT `pr_projects`.`name` FROM `pr_projects` WHERE `pr_projects`.`id`=sa.`pro_id`)AS project,
  'Adjustment' AS type_,
  4 AS type_no  
FROM
  `pr_stock_adjust_details` AS sad 
  INNER JOIN `pr_stock_adjusts` AS sa 
  ON sad.`adjust_id`=sa.`id`
  AND sa.`pro_id`=pro_
  AND sad.`warehouse_id` IN(warehouse_)
  AND sa.`trans_date` BETWEEN start_ AND end_
  AND sad.`delete`=0)AS E
UNION ALL
SELECT * FROM(SELECT 
  smd.`id`,
  smd.`move_id`,
  smd.`from_warehouse_id`,
  (SELECT 
    `pr_warehouses`.`name` 
  FROM
    `pr_warehouses` 
  WHERE `pr_warehouses`.`id` = smd.from_warehouse_id) AS warehouse,
  smd.`item_id`,
  (SELECT 
    `pr_items`.`code` 
  FROM
    `pr_items` 
  WHERE `pr_items`.`id` = smd.item_id) AS item_code,
  (SELECT 
    `pr_items`.`name` 
  FROM
    `pr_items` 
  WHERE `pr_items`.`id` = smd.item_id) AS item_name,
  smd.`qty`,
  smd.`unit`,
  sm.`created_by`,
  (SELECT 
    `pr_users`.`name` 
  FROM
    `pr_users` 
  WHERE `pr_users`.`id` = sm.created_by) AS created_name,
  sm.`trans_date`,
  sm.`ref_no`,
  sm.`pro_id`,
  (SELECT 
    `pr_projects`.`name` 
  FROM
    `pr_projects` 
  WHERE `pr_projects`.`id` = sm.`pro_id`) AS project,
  'Move Out' AS type_,
  3 AS type_no  
FROM
  `pr_stock_move_details` AS smd 
  INNER JOIN `pr_stock_moves` AS sm 
    ON smd.`move_id` = sm.`id` 
    AND sm.`pro_id` = pro_ 
    AND smd.`from_warehouse_id` IN (warehouse_) 
    AND sm.`trans_date` BETWEEN start_ 
    AND end_ 
    AND sm.`delete` = 0 )AS F
UNION ALL
SELECT * FROM(SELECT 
  smd.`id`,
  smd.`move_id`,
  smd.`to_warehouse_id`,
  (SELECT 
    `pr_warehouses`.`name` 
  FROM
    `pr_warehouses` 
  WHERE `pr_warehouses`.`id` = smd.to_warehouse_id) AS warehouse,
  smd.`item_id`,
  (SELECT 
    `pr_items`.`code` 
  FROM
    `pr_items` 
  WHERE `pr_items`.`id` = smd.item_id) AS item_code,
  (SELECT 
    `pr_items`.`name` 
  FROM
    `pr_items` 
  WHERE `pr_items`.`id` = smd.item_id) AS item_name,
  smd.`qty`,
  smd.`unit`,
  sm.`created_by`,
  (SELECT 
    `pr_users`.`name` 
  FROM
    `pr_users` 
  WHERE `pr_users`.`id` = sm.created_by) AS created_name,
  sm.`trans_date`,
  sm.`ref_no`,
  sm.`pro_id`,
  (SELECT 
    `pr_projects`.`name` 
  FROM
    `pr_projects` 
  WHERE `pr_projects`.`id` = sm.`pro_id`) AS project,
  'Move In' AS type_,
  2 AS type_no  
FROM
  `pr_stock_move_details` AS smd 
  INNER JOIN `pr_stock_moves` AS sm 
    ON smd.`move_id` = sm.`id` 
    AND sm.`pro_id` = pro_ 
    AND smd.`to_warehouse_id` IN (warehouse_) 
    AND sm.`trans_date` BETWEEN start_ 
    AND end_ 
    AND sm.`delete` = 0)AS G
UNION ALL
SELECT * FROM(SELECT 
  st.`id`,
  st.`ref_id`,
  st.`warehouse_id`,
  (SELECT 
    `pr_warehouses`.`name` 
  FROM
    `pr_warehouses` 
  WHERE `pr_warehouses`.`id` = st.warehouse_id) AS warehouse,
  st.`item_id`,
  (SELECT 
    `pr_items`.`code` 
  FROM
    `pr_items` 
  WHERE `pr_items`.`id` = st.item_id) AS item_code,
  (SELECT 
    `pr_items`.`name` 
  FROM
    `pr_items` 
  WHERE `pr_items`.`id` = st.item_id) AS item_name,
  st.`qty`,
  (SELECT `pr_units`.`from_desc` FROM `pr_units` WHERE `pr_units`.`from_code`=st.`unit` LIMIT 1)AS unit,
  se.`created_by`,
  (SELECT 
    `pr_users`.`name` 
  FROM
    `pr_users` 
  WHERE `pr_users`.`id` = se.created_by) AS created_name,
  se.`trans_date`,
  st.`ref_no`,
  st.`pro_id`,
  (SELECT 
    `pr_projects`.`name` 
  FROM
    `pr_projects` 
  WHERE `pr_projects`.`id` = st.`pro_id`) AS project,
  'Stock Entry' AS type_,
  1 AS type_no  
FROM
  `pr_stock_entries` AS se 
  INNER JOIN `pr_stocks` AS st 
    ON st.`ref_id` = se.`id` 
    AND st.`ref_no` = se.`ref_no` 
    AND se.`pro_id` = pro_ 
    AND se.`trans_date` BETWEEN start_ 
    AND end_ 
    AND st.`warehouse_id` IN (warehouse_) 
    AND st.`delete` = 0 )AS H
    UNION ALL
    SELECT * FROM(SELECT 
  st.`id`,
  st.`ref_id`,
  st.`warehouse_id`,
  (SELECT 
    `pr_warehouses`.`name` 
  FROM
    `pr_warehouses` 
  WHERE `pr_warehouses`.`id` = st.warehouse_id) AS warehouse,
  st.`item_id`,
  (SELECT 
    `pr_items`.`code` 
  FROM
    `pr_items` 
  WHERE `pr_items`.`id` = st.item_id) AS item_code,
  (SELECT 
    `pr_items`.`name` 
  FROM
    `pr_items` 
  WHERE `pr_items`.`id` = st.item_id) AS item_name,
  st.`qty`,
  (SELECT `pr_units`.`from_desc` FROM `pr_units` WHERE `pr_units`.`from_code`=st.`unit` LIMIT 1)AS unit,
  se.`created_by`,
  (SELECT 
    `pr_users`.`name` 
  FROM
    `pr_users` 
  WHERE `pr_users`.`id` = se.created_by) AS created_name,
  se.`trans_date`,
  st.`ref_no`,
  st.`pro_id`,
  (SELECT 
    `pr_projects`.`name` 
  FROM
    `pr_projects` 
  WHERE `pr_projects`.`id` = st.`pro_id`) AS project,
  'Stock Entry' AS type_,
  1 AS type_no  
FROM
  `pr_stock_imports` AS se 
  INNER JOIN `pr_stocks` AS st 
    ON st.`ref_id` = se.`id` 
    AND st.`ref_no` = se.`ref_no` 
    AND se.`pro_id` = pro_ 
    AND se.`trans_date` BETWEEN start_ 
    AND end_ 
    AND st.`warehouse_id` IN (warehouse_) 
    AND st.`delete` = 0 )AS I)AS AA WHERE AA.qty!=0);
	ELSE
	(SELECT * FROM(SELECT * FROM(SELECT 
  ud.id,
  ud.`use_id`,
  ud.`warehouse_id`,
  (SELECT `pr_warehouses`.`name` FROM `pr_warehouses` WHERE `pr_warehouses`.`id`=ud.`warehouse_id`)AS warehouse,
  ud.`item_id`,
  (SELECT `pr_items`.`code` FROM `pr_items` WHERE `pr_items`.`id`=ud.item_id)AS item_code,
  (SELECT `pr_items`.`name` FROM `pr_items` WHERE `pr_items`.`id`=ud.item_id)AS item_name,
  ud.`qty`,
  (SELECT `pr_units`.`from_desc` FROM `pr_units` WHERE `pr_units`.`from_code`=ud.unit LIMIT 1)AS unit,
  ud.`created_by`,
  (SELECT `pr_users`.`name` FROM `pr_users` WHERE `pr_users`.`id`=ud.`created_by`)AS created_name,
  u.`trans_date`,
  u.`ref_no`,
  u.`pro_id`,
  (SELECT `pr_projects`.`name` FROM `pr_projects` WHERE `pr_projects`.`id`=u.`pro_id`)AS project,
  'Usage' AS type_,
  5 AS type_no 
FROM
  `pr_usage_details` AS ud 
  INNER JOIN `pr_usages` AS u 
    ON ud.`use_id` = u.id 
    AND u.`pro_id` = pro_ 
    AND ud.`warehouse_id` IN (warehouse_) 
    AND u.`trans_date` BETWEEN start_ 
    AND end_ 
    AND ud.`delete` = 0 )AS A
UNION ALL
SELECT * FROM(SELECT 
  di.`id`,
  di.`del_id`,
  di.`warehouse_id`,
  (SELECT `pr_warehouses`.`name` FROM `pr_warehouses` WHERE `pr_warehouses`.`id`=di.warehouse_id) AS warehouse,
  di.item_id,
  (SELECT `pr_items`.`code` FROM `pr_items` WHERE `pr_items`.`id`=di.item_id) AS item_code,
  (SELECT `pr_items`.`name` FROM `pr_items` WHERE `pr_items`.`id`=di.item_id) AS item_name,
  di.qty,
  (SELECT `pr_units`.`from_desc` FROM `pr_units` WHERE `pr_units`.`from_code`=di.unit LIMIT 1) AS unit,
  d.created_by,
  (SELECT `pr_users`.`name` FROM `pr_users` WHERE `pr_users`.`id`=d.created_by) AS created_name,
  d.trans_date,
  d.ref_no,
  d.pro_id,
  (SELECT `pr_projects`.`name` FROM `pr_projects` WHERE `pr_projects`.`id`=d.`pro_id`) AS project,
  'Delivery' AS type_,
  7 AS type_no  
FROM
  `pr_delivery_items` AS di 
  INNER JOIN `pr_deliveries` AS d 
  ON di.`del_id`=d.`id`
  AND d.`pro_id`=pro_
  AND di.`warehouse_id` IN(warehouse_)
  AND d.`trans_date` BETWEEN start_ AND end_
  AND d.`delete`=0)AS B
UNION ALL
SELECT * FROM(SELECT 
  rdi.`id`,
  rdi.`return_id`,
  rdi.`warehouse_id`,
  (SELECT `pr_warehouses`.`name` FROM `pr_warehouses` WHERE `pr_warehouses`.`id`=rdi.warehouse_id) AS warehouse,
  rdi.item_id,
  (SELECT `pr_items`.`code` FROM `pr_items` WHERE `pr_items`.`id`=rdi.item_id) AS item_code,
  (SELECT `pr_items`.`name` FROM `pr_items` WHERE `pr_items`.`id`=rdi.item_id) AS item_name,
  rdi.qty,
  (SELECT `pr_units`.`from_desc` FROM `pr_units` WHERE `pr_units`.`from_code`=rdi.unit LIMIT 1) AS unit,
  rd.created_by,
  (SELECT `pr_users`.`name` FROM `pr_users` WHERE `pr_users`.`id`=rd.created_by) AS created_name,
  rd.trans_date,
  rd.ref_no,
  rd.pro_id,
  (SELECT `pr_projects`.`name` FROM `pr_projects` WHERE `pr_projects`.`id`=rd.`pro_id`)AS project,
  'Return Delivery' AS type_,
  8 AS type_no 
FROM
  `pr_return_delivery_items` AS rdi 
  INNER JOIN `pr_return_deliveries` AS rd 
  ON rdi.`return_id`=rd.`id`
  AND rd.`pro_id`=pro_
  AND rd.`delete`=0
  AND rd.`trans_date` BETWEEN start_ AND end_
  AND rdi.`warehouse_id` IN(warehouse_))AS C
UNION ALL
SELECT * FROM(SELECT 
  rud.`id`,
  rud.`return_id`,
  rud.`warehouse_id`,
  (SELECT `pr_warehouses`.`name` FROM `pr_warehouses` WHERE `pr_warehouses`.`id`=rud.warehouse_id)AS warehouse,
  rud.`item_id`,
  (SELECT `pr_items`.`code` FROM `pr_items` WHERE `pr_items`.`id`=rud.item_id)AS item_code,
  (SELECT `pr_items`.`name` FROM `pr_items` WHERE `pr_items`.`id`=rud.item_id)AS item_name,
  rud.`qty`,
  (SELECT `pr_units`.`from_desc` FROM `pr_units` WHERE `pr_units`.`from_code`=rud.unit LIMIT 1)AS unit,
  ru.`created_by`,
  (SELECT `pr_users`.`name` FROM `pr_users` WHERE `pr_users`.`id`=ru.created_by)AS created_name,
  ru.`trans_date`,
  ru.`ref_no`,
  ru.`pro_id`,
  (SELECT `pr_projects`.`name` FROM `pr_projects` WHERE `pr_projects`.`id`=ru.`pro_id`)AS project,
  'Return Usage' AS type_,
  6 AS type_no  
FROM
  `pr_return_usage_details` AS rud 
  INNER JOIN `pr_return_usages` AS ru )AS D
UNION ALL
SELECT * FROM(SELECT 
  sad.`id`,
  sad.`adjust_id`,
  sad.`warehouse_id`,
  (SELECT `pr_warehouses`.`name` FROM `pr_warehouses` WHERE `pr_warehouses`.`id`=sad.warehouse_id)AS warehouse,
  sad.`item_id`,
  (SELECT `pr_items`.`code` FROM `pr_items` WHERE `pr_items`.`id`=sad.item_id)AS item_code,
  (SELECT `pr_items`.`name` FROM `pr_items` WHERE `pr_items`.`id`=sad.item_id)AS item_name,
  sad.`adjust_qty`,
  sad.`unit`,
  sad.`created_by`,
  (SELECT `pr_users`.`name` FROM `pr_users` WHERE `pr_users`.`id`=sad.created_by)AS created_name,
  sa.`trans_date`,
  sa.`ref_no`,
  sa.`pro_id`,
  (SELECT `pr_projects`.`name` FROM `pr_projects` WHERE `pr_projects`.`id`=sa.`pro_id`)AS project,
  'Adjustment' AS type_,
  4 AS type_no  
FROM
  `pr_stock_adjust_details` AS sad 
  INNER JOIN `pr_stock_adjusts` AS sa 
  ON sad.`adjust_id`=sa.`id`
  AND sa.`pro_id`=pro_
  AND sad.`warehouse_id` IN(warehouse_)
  AND sa.`trans_date` BETWEEN start_ AND end_
  AND sad.`delete`=0)AS E
UNION ALL
SELECT * FROM(SELECT 
  smd.`id`,
  smd.`move_id`,
  smd.`from_warehouse_id`,
  (SELECT 
    `pr_warehouses`.`name` 
  FROM
    `pr_warehouses` 
  WHERE `pr_warehouses`.`id` = smd.from_warehouse_id) AS warehouse,
  smd.`item_id`,
  (SELECT 
    `pr_items`.`code` 
  FROM
    `pr_items` 
  WHERE `pr_items`.`id` = smd.item_id) AS item_code,
  (SELECT 
    `pr_items`.`name` 
  FROM
    `pr_items` 
  WHERE `pr_items`.`id` = smd.item_id) AS item_name,
  smd.`qty`,
  smd.`unit`,
  sm.`created_by`,
  (SELECT 
    `pr_users`.`name` 
  FROM
    `pr_users` 
  WHERE `pr_users`.`id` = sm.created_by) AS created_name,
  sm.`trans_date`,
  sm.`ref_no`,
  sm.`pro_id`,
  (SELECT 
    `pr_projects`.`name` 
  FROM
    `pr_projects` 
  WHERE `pr_projects`.`id` = sm.`pro_id`) AS project,
  'Move Out' AS type_,
  3 AS type_no  
FROM
  `pr_stock_move_details` AS smd 
  INNER JOIN `pr_stock_moves` AS sm 
    ON smd.`move_id` = sm.`id` 
    AND sm.`pro_id` = pro_ 
    AND smd.`from_warehouse_id` IN (warehouse_) 
    AND sm.`trans_date` BETWEEN start_ 
    AND end_ 
    AND sm.`delete` = 0 )AS F
UNION ALL
SELECT * FROM(SELECT 
  smd.`id`,
  smd.`move_id`,
  smd.`to_warehouse_id`,
  (SELECT 
    `pr_warehouses`.`name` 
  FROM
    `pr_warehouses` 
  WHERE `pr_warehouses`.`id` = smd.to_warehouse_id) AS warehouse,
  smd.`item_id`,
  (SELECT 
    `pr_items`.`code` 
  FROM
    `pr_items` 
  WHERE `pr_items`.`id` = smd.item_id) AS item_code,
  (SELECT 
    `pr_items`.`name` 
  FROM
    `pr_items` 
  WHERE `pr_items`.`id` = smd.item_id) AS item_name,
  smd.`qty`,
  smd.`unit`,
  sm.`created_by`,
  (SELECT 
    `pr_users`.`name` 
  FROM
    `pr_users` 
  WHERE `pr_users`.`id` = sm.created_by) AS created_name,
  sm.`trans_date`,
  sm.`ref_no`,
  sm.`pro_id`,
  (SELECT 
    `pr_projects`.`name` 
  FROM
    `pr_projects` 
  WHERE `pr_projects`.`id` = sm.`pro_id`) AS project,
  'Move In' AS type_,
  2 AS type_no  
FROM
  `pr_stock_move_details` AS smd 
  INNER JOIN `pr_stock_moves` AS sm 
    ON smd.`move_id` = sm.`id` 
    AND sm.`pro_id` = pro_ 
    AND smd.`to_warehouse_id` IN (warehouse_) 
    AND sm.`trans_date` BETWEEN start_ 
    AND end_ 
    AND sm.`delete` = 0)AS G
UNION ALL
SELECT * FROM(SELECT 
  st.`id`,
  st.`ref_id`,
  st.`warehouse_id`,
  (SELECT 
    `pr_warehouses`.`name` 
  FROM
    `pr_warehouses` 
  WHERE `pr_warehouses`.`id` = st.warehouse_id) AS warehouse,
  st.`item_id`,
  (SELECT 
    `pr_items`.`code` 
  FROM
    `pr_items` 
  WHERE `pr_items`.`id` = st.item_id) AS item_code,
  (SELECT 
    `pr_items`.`name` 
  FROM
    `pr_items` 
  WHERE `pr_items`.`id` = st.item_id) AS item_name,
  st.`qty`,
  (SELECT `pr_units`.`from_desc` FROM `pr_units` WHERE `pr_units`.`from_code`=st.`unit` LIMIT 1)AS unit,
  se.`created_by`,
  (SELECT 
    `pr_users`.`name` 
  FROM
    `pr_users` 
  WHERE `pr_users`.`id` = se.created_by) AS created_name,
  se.`trans_date`,
  st.`ref_no`,
  st.`pro_id`,
  (SELECT 
    `pr_projects`.`name` 
  FROM
    `pr_projects` 
  WHERE `pr_projects`.`id` = st.`pro_id`) AS project,
  'Stock Entry' AS type_,
  1 AS type_no  
FROM
  `pr_stock_entries` AS se 
  INNER JOIN `pr_stocks` AS st 
    ON st.`ref_id` = se.`id` 
    AND st.`ref_no` = se.`ref_no` 
    AND se.`pro_id` = pro_ 
    AND se.`trans_date` BETWEEN start_ 
    AND end_ 
    AND st.`warehouse_id` IN (warehouse_) 
    AND st.`delete` = 0 )AS H
    UNION ALL
    SELECT * FROM(SELECT 
  st.`id`,
  st.`ref_id`,
  st.`warehouse_id`,
  (SELECT 
    `pr_warehouses`.`name` 
  FROM
    `pr_warehouses` 
  WHERE `pr_warehouses`.`id` = st.warehouse_id) AS warehouse,
  st.`item_id`,
  (SELECT 
    `pr_items`.`code` 
  FROM
    `pr_items` 
  WHERE `pr_items`.`id` = st.item_id) AS item_code,
  (SELECT 
    `pr_items`.`name` 
  FROM
    `pr_items` 
  WHERE `pr_items`.`id` = st.item_id) AS item_name,
  st.`qty`,
  (SELECT `pr_units`.`from_desc` FROM `pr_units` WHERE `pr_units`.`from_code`=st.`unit` LIMIT 1)AS unit,
  se.`created_by`,
  (SELECT 
    `pr_users`.`name` 
  FROM
    `pr_users` 
  WHERE `pr_users`.`id` = se.created_by) AS created_name,
  se.`trans_date`,
  st.`ref_no`,
  st.`pro_id`,
  (SELECT 
    `pr_projects`.`name` 
  FROM
    `pr_projects` 
  WHERE `pr_projects`.`id` = st.`pro_id`) AS project,
  'Stock Entry' AS type_,
  1 AS type_no  
FROM
  `pr_stock_imports` AS se 
  INNER JOIN `pr_stocks` AS st 
    ON st.`ref_id` = se.`id` 
    AND st.`ref_no` = se.`ref_no` 
    AND se.`pro_id` = pro_ 
    AND se.`trans_date` BETWEEN start_ 
    AND end_ 
    AND st.`warehouse_id` IN (warehouse_) 
    AND st.`delete` = 0 )AS I)AS AA WHERE AA.type_no=type_ AND AA.qty!=0);
	END IF;
    END$$
DELIMITER ;