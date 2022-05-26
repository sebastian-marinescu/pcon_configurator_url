<?php

namespace PrestaShop\Module\PconConfiguratorUrl\Form;

interface FormDataHandlerInterface
{
    /*
     * @param array $data form data
     *
     * @return bool
     *
     * @throws ModuleErrorException
     */
    public function save(array $data): bool;

    /*
    * @param array $params
    *
    * @return array
    */
    public function getData(array $params): array;

}