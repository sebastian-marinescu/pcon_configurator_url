<?php
        
    namespace PrestaShop\Module\PconConfiguratorUrl\Form\Product\Hooks;

    use PrestaShop\Module\PconConfiguratorUrl\Form\Product\Hooks\HookFieldsBuilderInterface;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Module;

    class HookDisplayAdminProductsMainStepLeftColumnMiddleFieldsBuilder implements HookFieldsBuilderInterface
    {
        public function addFields(FormBuilderInterface $adminFormBuilder, Module $module) :FormBuilderInterface
        {
            return $adminFormBuilder;
        }
    }
