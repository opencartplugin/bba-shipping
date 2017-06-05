ALTER TABLE `oc_address`
  ADD COLUMN `bbacountry` varchar(3) NULL,
  ADD COLUMN `bbacity` int(11) NULL,
  ADD COLUMN `bbapostcode` varchar(20) NULL;

ALTER TABLE `oc_order` ADD `payment_bbacountry` VARCHAR(3) NULL DEFAULT NULL AFTER `date_modified`, ADD `shipping_bbacountry` VARCHAR(3) NULL DEFAULT NULL AFTER `payment_bbacountry`, ADD `payment_bbacity` INT(11) NULL DEFAULT NULL AFTER `shipping_bbacountry`, ADD `shipping_bbacity` INT(11) NULL DEFAULT NULL AFTER `payment_bbacity`, ADD `payment_bbapostcode` VARCHAR(20) NULL DEFAULT NULL AFTER `shipping_bbacity`, ADD `shipping_bbapostcode` VARCHAR(20) NULL DEFAULT NULL AFTER `payment_bbapostcode`;

