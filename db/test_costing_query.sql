SELECT 
  b.id,
  b.ref_no AS CODE,
  b.trans_date,
  b.main_cost,
  b.warehouse_id,
  b.item_id,
  (
    CASE
      WHEN b.min_unit_to_code != '' 
      THEN b.min_unit_to_code 
      ELSE b.unit 
    END
  ) AS unit,
  (b.qty * b.unit_qty) AS qty,
  (b.cost / b.unit_qty) AS cost,
  b.type_ 
FROM
  (SELECT 
    a.*,
    (
      CASE
        WHEN 
        (SELECT 
          `pr_units`.`factor` 
        FROM
          `pr_units` 
        WHERE pr_units.`from_code` = a.unit 
          AND pr_units.`to_code` = 
          (SELECT 
            pr_items.`unit_stock` 
          FROM
            pr_items 
          WHERE pr_items.`id` = a.item_id)) != '' 
        THEN 
        (SELECT 
          `pr_units`.`factor` 
        FROM
          `pr_units` 
        WHERE pr_units.`from_code` = a.unit 
          AND pr_units.`to_code` = 
          (SELECT 
            pr_items.`unit_stock` 
          FROM
            pr_items 
          WHERE pr_items.`id` = a.item_id)) 
        ELSE 1 
      END
    ) AS unit_qty,
    (SELECT 
      pr_units.`to_code` 
    FROM
      pr_units 
    WHERE pr_units.`from_code` = 
      (SELECT 
        pr_items.`unit_stock` 
      FROM
        pr_items 
      WHERE pr_items.`id` = a.item_id) 
      AND pr_units.`to_code` = 
      (SELECT 
        pr_units.`to_code` 
      FROM
        pr_units 
      WHERE pr_units.`from_code` = a.unit 
        AND pr_units.`factor` = 
        (SELECT 
          MIN(pr_units.`factor`) 
        FROM
          pr_units 
        WHERE pr_units.`from_code` = a.unit) 
      LIMIT 1)) AS min_unit_to_code 
  FROM
    (
    /*ENTRY*/
    SELECT 
      ent.`id`,
      ent.`ref_no`,
      ent.`trans_date`,
      ent.cost AS main_cost,
      st.`warehouse_id`,
      st.`item_id`,
      st.`unit`,
      st.`qty`,
      st.cost,
      'ENT' AS type_ 
    FROM
      `pr_stock_entries` AS ent 
      INNER JOIN pr_stocks AS st 
        ON st.`ref_id` = ent.`id` 
        AND ent.`ref_no` = st.`ref_no` 
        AND ent.`pro_id` = 2 
        AND ent.`delete` = 0 
        AND st.`delete` = 0 
        AND st.`item_id` = 1279 
    UNION
    ALL 
    /*DELIVERY*/
    SELECT 
      del.id,
      del.ref_no,
      del.trans_date,
      del.total_cost,
      st.`warehouse_id`,
      st.item_id,
      st.`unit`,
      st.`qty`,
      st.`cost`,
      'ENT' AS type_ 
    FROM
      `pr_deliveries` AS del 
      INNER JOIN `pr_delivery_items` AS st 
        ON st.`del_id` = del.id 
        AND del.pro_id = 2 
        AND del.delete = 0 
        AND st.`item_id` = 1279 
    UNION
    ALL 
    /*USAGE*/
    SELECT 
      us.id,
      us.ref_no,
      us.trans_date,
      us.total_cost,
      st.`warehouse_id`,
      st.`item_id`,
      st.`unit`,
      st.`qty`,
      st.`total_cost` AS cost,
      'INV' AS type_ 
    FROM
      `pr_usages` AS us 
      INNER JOIN `pr_usage_details` AS st 
        ON st.`use_id` = us.id 
        AND us.pro_id = 2 
        AND us.delete = 0 
        AND st.`delete` = 0 
        AND st.`item_id` = 1279 
    UNION
    ALL 
    /*RETURN USAGE*/
    SELECT 
      us.id,
      us.ref_no,
      us.trans_date,
      us.total_cost,
      st.`warehouse_id`,
      st.`item_id`,
      st.`unit`,
      st.`usage_qty`,
      st.`total_cost` AS cost,
      'ENT' AS type_ 
    FROM
      `pr_return_usages` AS us 
      INNER JOIN `pr_return_usage_details` AS st 
        ON st.`return_id` = us.id 
        AND us.pro_id = 2 
        AND us.delete = 0 
        AND st.`delete` = 0 
        AND st.`item_id` = 1279 
    UNION
    ALL 
    /*Stock Adjust*/
    SELECT 
      sad.id,
      sad.ref_no,
      sad.trans_date,
      sad.total_cost AS main_cost,
      st.`warehouse_id`,
      st.`item_id`,
      st.`unit`,
      st.`adjust_qty`,
      st.total_cost AS cost,
      'ADJ' AS type_ 
    FROM
      pr_stock_adjusts AS sad 
      INNER JOIN `pr_stock_adjust_details` AS st 
        ON st.`adjust_id` = sad.`id` 
        AND sad.`pro_id` = 2 
        AND sad.`delete` = 0 
        AND st.`item_id` = 1279 
    UNION
    ALL 
    /*RETURN DELIVERY*/
    SELECT 
      rd.id,
      rd.ref_no,
      rd.trans_date,
      0 AS main_cost,
      st.`warehouse_id`,
      st.`item_id`,
      st.`unit`,
      st.`qty`,
      0 AS cost,
      'INV' AS type_ 
    FROM
      pr_return_deliveries AS rd 
      INNER JOIN `pr_return_delivery_items` AS st 
        ON rd.`id` = st.`return_id` 
        AND rd.`pro_id` = 2 
        AND rd.`delete` = 0 
        AND st.`item_id` = 1279) AS a) AS b ORDER BY b.trans_date ASC