SELECT 
  AE.* 
FROM
  (SELECT 
    AA.* 
  FROM
    (SELECT 
      B.id,
      B.code,
      B.trans_date,
      (0) AS main_cost,
      B.item_id,
      (B.qty * B.unit_qty) AS qty,
      (B.cost / B.unit_qty) AS cost,
      B.warehouse_id,
      'ENT' AS type_ 
    FROM
      (SELECT 
        A.id,
        A.code,
        A.trans_date,
        A.item_id,
        A.unit_id,
        (
          CASE
            WHEN 
            (SELECT 
              `j_item_units`.`qty` 
            FROM
              `j_item_units` 
            WHERE `j_item_units`.`item_id` = A.item_id 
              AND `j_item_units`.`unit_id` = A.unit_id 
            LIMIT 1) != '' 
            THEN 
            (SELECT 
              `j_item_units`.`qty` 
            FROM
              `j_item_units` 
            WHERE `j_item_units`.`item_id` = A.item_id 
              AND `j_item_units`.`unit_id` = A.unit_id 
            LIMIT 1) 
            ELSE 1 
          END
        ) AS unit_qty,
        A.qty,
        A.cost,
        A.warehouse_id 
      FROM
        (SELECT 
          se.`id`,
          se.`code`,
          se.`trans_date`,
          sei.`item_id`,
          sei.`unit_id`,
          sei.`qty`,
          sei.`cost`,
          sei.`warehouse_id` 
        FROM
          `j_stock_entries` AS se 
          INNER JOIN `j_stock_entry_items` AS sei 
            ON sei.`stock_entry_id` = se.`id` 
            AND sei.`item_id` = 21 
            AND se.`delete` = 0) AS A) AS B) AS AA 
  UNION
  ALL 
  SELECT 
    AP.* 
  FROM
    (SELECT 
      B.id,
      B.ref_no,
      B.trans_date,
      B.main_cost,
      B.item_id,
      (B.qty * B.unit_qty) AS qty,
      (B.cost / B.unit_qty) AS cost,
      B.warehouse_id,
      'ENT' AS type_ 
    FROM
      (SELECT 
        A.id,
        A.ref_no,
        A.trans_date,
        A.main_cost,
        A.item_id,
        A.unit_id,
        (
          CASE
            WHEN 
            (SELECT 
              `j_item_units`.`qty` 
            FROM
              `j_item_units` 
            WHERE `j_item_units`.`item_id` = A.item_id 
              AND `j_item_units`.`unit_id` = A.unit_id 
            LIMIT 1) != '' 
            THEN 
            (SELECT 
              `j_item_units`.`qty` 
            FROM
              `j_item_units` 
            WHERE `j_item_units`.`item_id` = A.item_id 
              AND `j_item_units`.`unit_id` = A.unit_id 
            LIMIT 1) 
            ELSE 1 
          END
        ) AS unit_qty,
        A.qty,
        A.cost,
        A.warehouse_id 
      FROM
        (SELECT 
          st.id,
          st.`ref_no`,
          st.`trans_date`,
          0 AS main_cost,
          st.`item_id`,
          st.`unit_id`,
          st.warehouse_id,
          st.`qty`,
          st.`cost`,
          (
            CASE
              WHEN 
              (SELECT 
                `j_jewelry_refs`.`id` 
              FROM
                `j_jewelry_refs` 
              WHERE `j_jewelry_refs`.`item_id` = st.item_id 
                AND `j_jewelry_refs`.`delete` = 0 
              LIMIT 1) != '' 
              THEN 1 
              ELSE 0 
            END
          ) AS cast_active 
        FROM
          `j_stocks` AS st 
        WHERE st.item_id = 21 
          AND st.cust1 = 'ENT') AS A 
      WHERE A.cast_active = 1) AS B) AS AP 
  UNION
  ALL 
  SELECT 
    AB.* 
  FROM
    (SELECT 
      B.id,
      B.code,
      B.trans_date,
      B.main_cost,
      B.item_id,
      (B.qty * B.unit_qty) AS qty,
      (B.cost / B.unit_qty) AS cost,
      (16) AS warehouse_id,
      'JCE' AS type_ 
    FROM
      (SELECT 
        A.id,
        A.code,
        A.trans_date,
        A.main_cost,
        A.item_id,
        A.unit_id,
        (
          CASE
            WHEN 
            (SELECT 
              `j_item_units`.`qty` 
            FROM
              `j_item_units` 
            WHERE `j_item_units`.`item_id` = A.item_id 
              AND `j_item_units`.`unit_id` = A.unit_id 
            LIMIT 1) != '' 
            THEN 
            (SELECT 
              `j_item_units`.`qty` 
            FROM
              `j_item_units` 
            WHERE `j_item_units`.`item_id` = A.item_id 
              AND `j_item_units`.`unit_id` = A.unit_id 
            LIMIT 1) 
            ELSE 1 
          END
        ) AS unit_qty,
        A.qty,
        A.cost 
      FROM
        (SELECT 
          jec.id,
          jec.`code`,
          jec.`trans_date`,
          jec.`cost` AS main_cost,
          jeci.`item_id`,
          jeci.`unit_id`,
          jeci.`qty`,
          jeci.`cost` 
        FROM
          `j_jewelry_entry_costs` AS jec 
          INNER JOIN `j_jewelry_entry_cost_items` AS jeci 
            ON jeci.`jec_id` = jec.`id` 
            AND jeci.item_id = 21 
            AND jec.`delete` = 0 
            AND jeci.`delete` = 0) AS A) AS B) AS AB 
  UNION
  ALL 
  SELECT 
    AC.* 
  FROM
    (SELECT 
      B.id,
      B.code,
      B.sale_date,
      (0) AS main_cost,
      B.item_id,
      (B.qty * B.unit_qty) AS qty,
      (B.cost / B.unit_qty) AS cost,
      B.from_warehouse,
      'INV' AS type_ 
    FROM
      (SELECT 
        A.id,
        A.code,
        A.sale_date,
        A.item_id,
        A.unit_id,
        (
          CASE
            WHEN 
            (SELECT 
              `j_item_units`.`qty` 
            FROM
              `j_item_units` 
            WHERE `j_item_units`.`item_id` = A.item_id 
              AND `j_item_units`.`unit_id` = A.unit_id 
            LIMIT 1) != '' 
            THEN 
            (SELECT 
              `j_item_units`.`qty` 
            FROM
              `j_item_units` 
            WHERE `j_item_units`.`item_id` = A.item_id 
              AND `j_item_units`.`unit_id` = A.unit_id 
            LIMIT 1) 
            ELSE 1 
          END
        ) AS unit_qty,
        A.qty,
        A.cost,
        A.from_warehouse 
      FROM
        (SELECT 
          s.`id`,
          s.`code`,
          s.`sale_date`,
          si.`item_id`,
          si.`unit_id`,
          si.`dis_qty` AS qty,
          si.`cost`,
          si.`from_warehouse` 
        FROM
          `j_sales` AS s 
          INNER JOIN `j_sale_items` AS si 
            ON si.`sale_id` = s.id 
            AND si.item_id = 21 
            AND s.payment_status != 'hold' 
            AND s.`delete` = 0) AS A) AS B) AS AC 
  UNION
  ALL 
  SELECT 
    AD.* 
  FROM
    (SELECT 
      B.id,
      B.code,
      B.trans_date,
      (0) AS main_cost,
      B.item_id,
      (B.qty * B.unit_qty) AS qty,
      (B.cost / B.unit_qty) AS cost,
      B.warehouse_id,
      'ADJ' AS type_ 
    FROM
      (SELECT 
        A.id,
        A.code,
        A.trans_date,
        A.item_id,
        A.unit_id,
        (
          CASE
            WHEN 
            (SELECT 
              `j_item_units`.`qty` 
            FROM
              `j_item_units` 
            WHERE `j_item_units`.`item_id` = A.item_id 
              AND `j_item_units`.`unit_id` = A.unit_id 
            LIMIT 1) != '' 
            THEN 
            (SELECT 
              `j_item_units`.`qty` 
            FROM
              `j_item_units` 
            WHERE `j_item_units`.`item_id` = A.item_id 
              AND `j_item_units`.`unit_id` = A.unit_id 
            LIMIT 1) 
            ELSE 1 
          END
        ) AS unit_qty,
        A.qty,
        A.cost,
        A.warehouse_id 
      FROM
        (SELECT 
          adj.`id`,
          adj.`code`,
          adj.`trans_date`,
          adji.`item_id`,
          adji.`unit_id`,
          adji.`qty`,
          adji.`cost`,
          adji.`warehouse_id` 
        FROM
          `j_adjustments` AS adj 
          INNER JOIN `j_adjustment_items` AS adji 
            ON adji.`adjustment_id` = adj.`id` 
            AND adji.item_id = 21 
            AND adj.`delete` = 0) AS A) AS B) AS AD) AS AE 
WHERE AE.warehouse_id != 0 
  AND AE.item_id = 21 