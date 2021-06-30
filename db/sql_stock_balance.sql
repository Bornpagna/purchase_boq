SELECT 
  F.warehouse_id,
  (SELECT 
    pr_warehouses.`name` 
  FROM
    pr_warehouses 
  WHERE pr_warehouses.`id` = F.warehouse_id) AS warehouse,
  F.item_id,
  (SELECT 
    CONCAT(
      pr_items.`name`,
      ' (',
      pr_items.`code`,
      ')'
    ) AS `name` 
  FROM
    pr_items 
  WHERE pr_items.`id` = F.item_id) AS item,
  F.unit_stock,
  F.stock_in,
  F.stock_out,
  (F.stock_in - F.stock_out) AS current_stock 
FROM
  (SELECT 
    E.warehouse_id,
    E.item_id,
    E.unit_stock,
    SUM(E.stock_in) AS stock_in,
    SUM(E.stock_out) AS stock_out 
  FROM
    (SELECT 
      D.warehouse_id,
      D.item_id,
      D.unit_stock,
      (
        CASE
          WHEN D.stock_qty >= 0 
          THEN D.stock_qty 
          ELSE 0 
        END
      ) AS stock_in,
      (
        CASE
          WHEN D.stock_qty <= 0 
          THEN D.stock_qty 
          ELSE 0 
        END
      ) AS stock_out 
    FROM
      (SELECT 
        C.item_id,
        C.unit_stock,
        (C.qty * C.stock_qty) AS stock_qty,
        C.warehouse_id 
      FROM
        (SELECT 
          B.*,
          (SELECT 
            pr_units.`factor` 
          FROM
            pr_units 
          WHERE pr_units.`from_code` = B.unit 
            AND pr_units.`to_code` = B.unit_stock) AS stock_qty 
        FROM
          (SELECT 
            A.*,
            (SELECT 
              pr_items.`unit_stock` 
            FROM
              pr_items 
            WHERE pr_items.`id` = A.item_id) AS unit_stock 
          FROM
            (SELECT 
              pr_stocks.`item_id`,
              pr_stocks.`unit`,
              pr_stocks.`qty`,
              pr_stocks.`warehouse_id` 
            FROM
              pr_stocks 
            WHERE pr_stocks.`delete` = 0 
              AND pr_stocks.`pro_id` = 2 
              AND pr_stocks.`trans_date` BETWEEN '1900-01-01' 
              AND '2018-01-25') AS A) AS B) AS C) AS D) AS E 
  GROUP BY E.warehouse_id,
    E.item_id) AS F 