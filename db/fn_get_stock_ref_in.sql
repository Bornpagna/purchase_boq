SELECT 
  C.ref_no,
  C.item_id,
  C.unit_stock,
  (C.qty * C.qty_stock) AS qty_stock 
FROM
  (SELECT 
    B.*,
    (SELECT 
      pr_units.`factor` 
    FROM
      pr_units 
    WHERE pr_units.`from_code` = B.unit 
      AND pr_units.`to_code` = B.unit_stock) AS qty_stock 
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
        pr_stocks.`ref_no`,
        pr_stocks.`item_id`,
        pr_stocks.`unit`,
        pr_stocks.`qty` 
      FROM
        pr_stocks 
      WHERE pr_stocks.`delete` = 0 
        AND pr_stocks.`trans_ref` = 'I' 
        AND pr_stocks.`trans_date` > '2000-01-01' 
        AND pr_stocks.`pro_id`=2
        AND pr_stocks.`warehouse_id` = 6 
        AND pr_stocks.`item_id` = 1) AS A) AS B) AS C 