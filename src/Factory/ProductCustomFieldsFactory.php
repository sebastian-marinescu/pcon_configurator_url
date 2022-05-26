<?php

namespace PrestaShop\Module\PconConfiguratorUrl\Factory;

use PrestaShop\Module\PconConfiguratorUrl\Model\ProductCustomFields;

class ProductCustomFieldsFactory{

    public static function create(
        int $idProduct,
        ?int $idLang = null,
        ?int $idShop = null
    ): ProductCustomFields{
        return ProductCustomFields::getInstanceByProductId(
            $idProduct,
            $idLang,
            $idShop
        );
    }
}
