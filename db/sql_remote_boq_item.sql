SELECT 
  (F.stock_qty / F.use_qty) AS stock_qty 
FROM
  (SELECT 
    E.stock_qty,
    (SELECT 
      pr_units.`factor` 
    FROM
      pr_units 
    WHERE pr_units.`from_code` = 'កេស' 
      AND pr_units.`to_code` = E.unit_stock) AS use_qty 
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
              pr_boq_items.`id`,
              pr_boq_items.`item_id`,
              pr_boq_items.`unit`,
              (
                pr_boq_items.`qty_std` + pr_boq_items.`qty_add`
              ) AS qty 
            FROM
              pr_boq_items 
            WHERE pr_boq_items.`house_id` = 4 
              AND pr_boq_items.`item_id` = 1) AS A) AS B) AS C) AS D 
    GROUP BY D.item_id) AS E) AS F 