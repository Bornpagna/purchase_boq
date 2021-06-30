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
                pr_requests.`id` 
              FROM
                pr_requests 
              WHERE pr_requests.`pro_id` = 2 
                AND pr_requests.`trans_status` IN (1, 2, 3)) AS A 
              INNER JOIN 
                (SELECT 
                  pr_request_items.`pr_id`,
                  pr_request_items.item_id,
                  pr_request_items.`unit`,
                  (
                    pr_request_items.`qty` - pr_request_items.`closed_qty`
                  ) AS qty 
                FROM
                  pr_request_items 
                WHERE pr_request_items.`item_id` = 1) AS B 
                ON A.`id` = B.pr_id) AS C) AS D) AS E) AS F 
    GROUP BY F.item_id) AS G) AS H 