<?php

namespace PrestaShop\Module\PconConfiguratorUrl\Model;

use ObjectModel;
use DbQuery;
use Db;

class ProductCustomFields extends ObjectModel {
    /** @var int ID */
    public $id;

    /** @var int product ID */
    public $id_product;

    /** @var string  */
    public $pcon_configuratorurl_field;

    /** @var string Object creation date */
    public $date_add;

    /** @var string Object last modification date */
    public $date_upd;

    /**
     * @see ObjectModel::$definition
     */
    public static $definition = [
        'table' => 'pcon_configuratorurl',
        'primary' => 'id_pcon_configuratorurl',
        'multilang' => true,
        'multilang_shop' => true,
        'fields' => [
            'id_product' => [
                'type' => self::TYPE_INT,
                'validate' => 'isUnsignedId'
            ],
            'pcon_configuratorurl_field' => [
                'type' => self::TYPE_STRING,
                'validate' => 'isUrl'
            ],
            'date_add' => [
                'type' => self::TYPE_DATE,
                'validate' => 'isDate'
            ],
            'date_upd' => [
                'type' => self::TYPE_DATE,
                'validate' => 'isDate'
            ],
        ],
    ];

    public static function getInstanceByProductId(
        int $idProduct,
        ?int $idLang = null,
        ?int $idShop = null
    ) : self
    {
        $sql = new DbQuery();
        $sql->select(self::$definition['primary']);
        $sql->from(self::$definition['table'], 'b');
        $sql->where('b.id_product = '.(int)$idProduct);

        $idObject = (int)Db::getInstance()->getValue($sql);

        return (new self($idObject, $idLang, $idShop));
    }
}