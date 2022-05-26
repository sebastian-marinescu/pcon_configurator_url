<?php
        
    namespace PrestaShop\Module\PconConfiguratorUrl\Form\Product\Hooks;

    use PrestaShop\Module\PconConfiguratorUrl\Form\Product\Hooks\HookFieldsBuilderInterface;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Module;

    class HookDisplayAdminProductsMainStepLeftColumnBottomFieldsBuilder implements HookFieldsBuilderInterface
    {
        public function addFields(FormBuilderInterface $adminFormBuilder, Module $module) :FormBuilderInterface
        {
            $adminFormBuilder
                ->add('pcon_configurator_url_field', TextType::class, [
                    'label' => $module->l('pCon.UI Configurator-URL'),
                    'attr' => [
                        'class' => 'pcon-url'
                    ]
                ]);

            return $adminFormBuilder;
        }
    }
