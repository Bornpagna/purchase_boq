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
  WHERE pr_items.`id` = A.`item_id`) AS item,
  (SELECT 
    pr_warehouses.`name` 
  FROM
    pr_warehouses 
  WHERE pr_warehouses.`id` = A.warehouse_id) AS from_warehouse,
  (SELECT 
    pr_houses.`house_no` 
  FROM
    pr_houses 
  WHERE pr_houses.`id` = A.house_id) AS on_house 
FROM
  (SELECT 
    pr_usage_details.`id`,
    pr_usage_details.`line_no`,
    pr_usage_details.`item_id`,
    pr_usage_details.`unit`,
    pr_usage_details.`qty`,
    pr_usage_details.`note`,
    pr_usage_details.`warehouse_id`,
    pr_usage_details.`house_id` 
  FROM
    pr_usage_details 
  WHERE pr_usage_details.`delete` = 0 
    AND pr_usage_details.`use_id` = 1) AS A 