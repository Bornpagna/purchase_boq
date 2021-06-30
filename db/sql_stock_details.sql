SELECT 
  A.*,
  (SELECT 
    CONCAT(
      pr_items.`name`,
      ' (',
      pr_items.`code`,
      ')'
    ) AS `name` 
  FROM
    pr_items 
  WHERE pr_items.`id` = A.item_id) AS item,
  (SELECT 
    pr_warehouses.`name` 
  FROM
    pr_warehouses 
  WHERE pr_warehouses.`id` = A.warehouse_id) AS warehouse 
FROM
  (SELECT 
    pr_stocks.`trans_date`,
    pr_stocks.`ref_no`,
    pr_stocks.`line_no`,
    pr_stocks.`item_id`,
    pr_stocks.`unit`,
    pr_stocks.`qty`,
    pr_stocks.`warehouse_id`,
    pr_stocks.`ref_type`,
    pr_stocks.`reference` 
  FROM
    pr_stocks 
  WHERE pr_stocks.`item_id` = 17 
    AND pr_stocks.`warehouse_id` = 9 
    AND pr_stocks.`delete` = 0 
    AND pr_stocks.`pro_id` = 2 
    AND pr_stocks.`trans_date` BETWEEN '1900-01-01' 
    AND '2018-01-22') AS A 