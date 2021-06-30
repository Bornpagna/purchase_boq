ALTER TABLE `purchase_v3_db`.`pr_deliveries`   
  ADD COLUMN `total_cost` DECIMAL(50,4) DEFAULT 0  NOT NULL AFTER `updated_at`;

ALTER TABLE `purchase_v3_db`.`pr_delivery_items`   
  ADD COLUMN `cost` DECIMAL(50,4) DEFAULT 0  NOT NULL AFTER `desc`,
  ADD COLUMN `cost_info_json` TEXT NULL AFTER `cost`;

ALTER TABLE `purchase_v3_db`.`pr_return_deliveries`   
  ADD COLUMN `total_cost` DECIMAL(50,4) DEFAULT 0  NOT NULL AFTER `updated_at`;

ALTER TABLE `purchase_v3_db`.`pr_return_delivery_items`   
  ADD COLUMN `cost` DECIMAL(50,4) DEFAULT 0  NOT NULL AFTER `note`,
  ADD COLUMN `cost_info_json` TEXT NULL AFTER `cost`;

ALTER TABLE `purchase_v3_db`.`pr_return_usages`   
  ADD COLUMN `total_cost` DECIMAL(50,4) DEFAULT 0  NOT NULL AFTER `updated_at`;

ALTER TABLE `purchase_v3_db`.`pr_return_usage_details`   
  ADD COLUMN `total_cost` DECIMAL(50,4) DEFAULT 0  NOT NULL AFTER `updated_at`,
  ADD COLUMN `cost_info_json` TEXT NULL AFTER `total_cost`;

ALTER TABLE `purchase_v3_db`.`pr_stocks`   
  ADD COLUMN `cost` DECIMAL(50,4) DEFAULT 0  NOT NULL AFTER `updated_at`,
  ADD COLUMN `cost_info_json` TEXT NULL AFTER `cost`;

ALTER TABLE `purchase_v3_db`.`pr_stock_adjusts`   
  ADD COLUMN `total_cost` DECIMAL(50,4) DEFAULT 0  NOT NULL AFTER `updated_at`;

ALTER TABLE `purchase_v3_db`.`pr_stock_adjust_details`   
  ADD COLUMN `total_cost` DECIMAL(50,4) DEFAULT 0  NOT NULL AFTER `updated_at`,
  ADD COLUMN `cost_info_json` TEXT NULL AFTER `total_cost`;

ALTER TABLE `purchase_v3_db`.`pr_stock_entries`   
  ADD COLUMN `cost` DECIMAL(50,4) DEFAULT 0  NOT NULL AFTER `updated_at`;

ALTER TABLE `purchase_v3_db`.`pr_usages`   
  ADD COLUMN `total_cost` DECIMAL(50,4) DEFAULT 0  NOT NULL AFTER `updated_at`;

ALTER TABLE `purchase_v3_db`.`pr_usage_details`   
  ADD COLUMN `total_cost` DECIMAL(50,4) DEFAULT 0  NOT NULL AFTER `updated_at`,
  ADD COLUMN `cost_info_json` TEXT NULL AFTER `total_cost`;
