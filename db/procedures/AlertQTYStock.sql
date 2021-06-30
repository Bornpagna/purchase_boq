DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `AlertQTYStock`(IN `project` INT)
BEGIN
  (SELECT 
    * 
  FROM
    (SELECT 
      qa.item_id,
      qa.code,
      qa.name,
      qa.warehouse_id,
      qa.warehouse,
      qa.unit_stock,
      SUM(qa.new_stock_qty) AS stock_qty,
      qa.new_alert_qty 
    FROM
      (SELECT 
        pr_stocks.`id`,
        pr_stocks.`ref_no`,
        pr_stocks.`item_id`,
        pr_stock_alerts.`item_id` AS stock_alert_item_id,
        pr_items.`code`,
        pr_items.`name`,
        pr_stocks.`qty`,
        (
          pr_stocks.`qty` / pr_units.`factor`
        ) AS new_stock_qty,
        pr_stocks.`unit`,
        pr_items.`alert_qty`,
        (
          pr_items.`alert_qty` * pr_units.`factor`
        ) AS new_alert_qty,
        pr_items.`unit_stock`,
        pr_units.`factor`,
        pr_stocks.`pro_id`,
        pr_stocks.`warehouse_id`,
        pr_warehouses.`name` AS warehouse 
      FROM
        pr_stocks 
        RIGHT JOIN pr_items 
          ON pr_items.`id` = pr_stocks.`item_id` 
          AND pr_items.`alert_qty` > 0 
          AND pr_stocks.`pro_id` = project 
        RIGHT JOIN pr_stock_alerts 
          ON pr_stock_alerts.`item_id` = pr_stocks.`item_id` 
          AND pr_stock_alerts.`warehouse_id` = pr_stocks.`warehouse_id` 
        LEFT JOIN `pr_units` 
          ON `pr_units`.`from_code` = pr_stocks.`unit` 
          AND pr_units.`to_code` = pr_items.`unit_stock` 
        LEFT JOIN pr_warehouses 
          ON pr_warehouses.`id` = pr_stocks.`warehouse_id`) AS qa 
    GROUP BY qa.warehouse_id,
      qa.item_id) AS qb 
  WHERE qb.stock_qty <= qb.new_alert_qty) ;
END$$
DELIMITER ;