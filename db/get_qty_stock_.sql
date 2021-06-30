SELECT 
  (A.qty * A.qty_stock) AS qty_stock 
FROM
  (SELECT 
    (1) AS qty,
    (SELECT 
      pr_units.`factor` 
    FROM
      pr_units 
    WHERE pr_units.`from_code` = 'កេស' 
      AND pr_units.`to_code` = pr_items.`unit_stock`) AS qty_stock 
  FROM
    pr_items 
  WHERE pr_items.`id` = 1) AS A 