ALTER TABLE `oc_address`
  ADD COLUMN `bbacountry` varchar(3) NULL,
  ADD COLUMN `bbacity` int(11) NULL,
  ADD COLUMN `bbapostcode` varchar(20) NULL
)
