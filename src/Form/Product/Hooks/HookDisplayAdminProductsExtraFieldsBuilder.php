<?php
        
    namespace PrestaShop\Module\PconConfiguratorUrl\Form\Product\Hooks;

    use PrestaShop\Module\PconConfiguratorUrl\Form\Product\Hooks\HookFieldsBuilderInterface;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\TextareaType;
    use PrestaShopBundle\Form\Admin\Type\TranslatableType;
    use PrestaShopBundle\Form\Admin\Type\SwitchType;
    use Module;

    class HookDisplayAdminProductsExtraFieldsBuilder implements HookFieldsBuilderInterface
    {
        public function addFields(FormBuilderInterface $adminFormBuilder, Module $module) :FormBuilderInterface
        {
            return $adminFormBuilder;
        }
    }
