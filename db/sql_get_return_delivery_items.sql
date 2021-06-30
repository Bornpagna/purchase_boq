SELECT 
  (H.stock_qty / H.use_qty) AS stock_qty 
FROM
  (SELECT 
    G.stock_qty,
    (SELECT 
      pr_units.`factor` 
    FROM
      pr_units 
    WHERE pr_units.`from_code` = 'កេស' 
      AND pr_units.`to_code` = G.unit_stock) AS use_qty 
  FROM
    (SELECT 
      F.item_id,
      F.unit_stock,
      SUM(F.stock_qty) AS stock_qty 
    FROM
      (SELECT 
        E.item_id,
        E.unit_stock,
        (E.qty * E.stock_qty) AS stock_qty 
      FROM
        (SELECT 
          D.*,
          (SELECT 
            pr_units.`factor` 
          FROM
            pr_units 
          WHERE pr_units.`from_code` = D.unit 
            AND pr_units.`to_code` = D.unit_stock) AS stock_qty 
        FROM
          (SELECT 
            C.*,
            (SELECT 
              pr_items.`unit_stock` 
            FROM
              pr_items 
            WHERE pr_items.`id` = C.item_id) AS unit_stock 
          FROM
            (SELECT 
              B.item_id,
              B.unit,
              B.qty 
            FROM
              (SELECT 
                pr_return_delivery.`id` 
              FROM
                pr_return_delivery 
              WHERE pr_return_delivery.`pro_id` = 2 
                AND pr_return_delivery.`delete` = 0) AS A 
              INNER JOIN 
                (SELECT 
                  pr_return_delivery_items.`return_id`,
                  pr_return_delivery_items.item_id,
                  pr_return_delivery_items.`unit`,
                  pr_return_delivery_items.`qty`
                FROM
                  pr_return_delivery_items 
                WHERE pr_return_delivery_items.`item_id` = 1) AS B 
                ON A.`id` = B.return_id) AS C) AS D) AS E) AS F 
    GROUP BY F.item_id) AS G) AS H 