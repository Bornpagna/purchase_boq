SELECT 
  (F.stock_qty / F.adj_qty) AS stock_qty 
FROM
  (SELECT 
    E.stock_qty,
    (SELECT 
      pr_units.`factor` 
    FROM
      pr_units 
    WHERE pr_units.`from_code` = 'កន្លះ' 
      AND pr_units.`to_code` = E.unit_stock) AS adj_qty 
  FROM
    (SELECT 
      D.item_id,
      D.unit_stock,
      SUM(D.stock_qty) AS stock_qty 
    FROM
      (SELECT 
        C.item_id,
        C.unit_stock,
        (C.qty * C.stock_qty) AS stock_qty 
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
              pr_stocks.`qty` 
            FROM
              pr_stocks 
            WHERE pr_stocks.`item_id` = 1 
              AND pr_stocks.`warehouse_id` = 6 
              AND pr_stocks.`delete` = 0) AS A) AS B) AS C) AS D 
    GROUP BY D.item_id) AS E) AS F 