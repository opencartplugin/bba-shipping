<?php
class ModelExtensionShippingBbishipping extends Model {
	public function install() {
		$this->db->query("ALTER TABLE `" . DB_PREFIX . "order`
		ADD `payment_bbacountry` VARCHAR(3) NULL DEFAULT NULL,
		ADD `shipping_bbacountry` VARCHAR(3) NULL DEFAULT NULL,
		ADD `payment_bbacity` INT(11) NULL DEFAULT NULL,
		ADD `shipping_bbacity` INT(11) NULL DEFAULT NULL,
		ADD `payment_bbapostcode` VARCHAR(20) NULL DEFAULT NULL,
		ADD `shipping_bbapostcode` VARCHAR(20) NULL DEFAULT NULL");
		$this->db->query("ALTER TABLE " . DB_PREFIX . "address
		ADD COLUMN `bbacountry` varchar(3) NULL,
	  ADD COLUMN `bbacity` int(11) NULL,
	  ADD COLUMN `bbapostcode` varchar(20) NULL");
	}
	public function uninstall() {
		$this->db->query("ALTER TABLE `" . DB_PREFIX . "order`
		DROP `payment_bbacountry`,
		DROP `shipping_bbacountry`,
		DROP `payment_bbacity`,
		DROP `shipping_bbacity`,
		DROP `payment_bbapostcode`,
		DROP `shipping_bbapostcode`");

		$this->db->query("ALTER TABLE " . DB_PREFIX . "address
		DROP bbacountry,
		DROP bbacity,
		DROP bbapostcode");
		$this->load->model('extension/extension');
		$this->model_extension_extension->uninstall('shipping', $this->request->get['extension']);
	}

}
