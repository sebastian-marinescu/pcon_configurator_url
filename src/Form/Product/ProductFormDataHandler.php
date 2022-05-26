<?php

namespace PrestaShop\Module\PconConfiguratorUrl\Form\Product;

use PrestaShop\Module\PconConfiguratorUrl\Form\FormDataHandlerInterface;
use PrestaShop\PrestaShop\Core\Module\Exception\ModuleErrorException;
use PrestaShop\Module\PconConfiguratorUrl\Factory\ProductCustomFieldsFactory;
use Exception;

final class ProductFormDataHandler implements FormDataHandlerInterface
{
    public function save(array $data): bool{

        $idProduct = (int) $data['id_product'];
        $productCustomFields = ProductCustomFieldsFactory::create($idProduct);
        $productCustomFields->id_product = $idProduct;
        $productCustomFields->pcon_configurator_url_field = $data['pcon_configurator_url_field'];

        try {
            if($productCustomFields->save()){
                return true;
            }
        } catch(Exception $e){
            throw new ModuleErrorException($e->getMessage());
        }

        return true;
    }

    public function getData(array $params): array{
        $productCustomFields = ProductCustomFieldsFactory::create(
            (int)$params['id_product'],
            $params['id_lang'] ?? null,
            $params['id_shop'] ?? null
        );

        return [
            'id' => $productCustomFields->id,
            'id_product' => $productCustomFields->id_product,
            'pcon_configurator_url_field' => $productCustomFields->pcon_configurator_url_field,
        ];
    }
}
