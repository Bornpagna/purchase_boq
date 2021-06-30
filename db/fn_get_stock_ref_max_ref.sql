SELECT 
  MAX(pr_stocks.`alloc_ref`) AS max_val 
FROM
  pr_stocks 
WHERE pr_stocks.`delete` = 0 
  AND pr_stocks.`trans_ref` = 'O' 
  AND pr_stocks.`trans_date` > '2000-01-01' 
  AND pr_stocks.`pro_id` = 2 
  AND pr_stocks.`warehouse_id` = 6 
  AND pr_stocks.`item_id` = 1 