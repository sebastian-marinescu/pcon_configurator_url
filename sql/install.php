<?php

$sql = array();

$sql[] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'pcon_configuratorurl` (
    `id_pcon_configuratorurl` int(11) NOT NULL AUTO_INCREMENT,
    `id_product` int(11) unsigned NOT NULL,
    `pcon_configuratorurl_field` text DEFAULT NULL,
    `date_add` datetime NOT NULL,
    `date_upd` datetime NOT NULL,
    PRIMARY KEY  (`id_pcon_configuratorurl`),
    KEY `id_product` (`id_product`)
) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;';

foreach ($sql as $query) {
    if (Db::getInstance()->execute($query) == false) {
        return false;
    }
}
