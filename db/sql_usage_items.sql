SELECT 
  A.*,
  (SELECT 
    CONCAT(pr_constructors.`id_card`, ' (',`pr_constructors`.`name`,')')AS `name` 
  FROM
    pr_constructors 
  WHERE pr_constructors.`id` = A.eng_usage) AS engineer,
  (SELECT 
    CONCAT(pr_constructors.`id_card`, ' (',`pr_constructors`.`name`,')')AS `name` 
  FROM
    pr_constructors 
  WHERE pr_constructors.`id` = A.sub_usage) AS sub_constructor 
FROM
  (SELECT 
    pr_usages.`id`,
    pr_usages.`ref_no`,
    pr_usages.`trans_date`,
    pr_usages.`eng_usage`,
    pr_usages.`sub_usage`,
    pr_usages.`desc` 
  FROM
    pr_usages 
  WHERE pr_usages.`delete` = 0 
    AND pr_usages.`pro_id` = 2) AS A 