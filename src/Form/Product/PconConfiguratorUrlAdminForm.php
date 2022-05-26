<?php

namespace PrestaShop\Module\PconConfiguratorUrl\Form\Product;

use PrestaShopBundle\Form\Admin\Type\CommonAbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Module;
use Symfony\Component\OptionsResolver\OptionsResolver;
use PrestaShop\Module\PconConfiguratorUrl\Form\Product\Hooks\HookFieldsBuilderInterface;

class PconConfiguratorUrlAdminForm extends CommonAbstractType
{
    public function buildForm(FormBuilderInterface $adminFormBuilder, array $options)
    {
        $this->addFieldsByHook($options['hookFieldsBuilder'], $adminFormBuilder, $options['module']);
    }
    
    private function addFieldsByHook(
        HookFieldsBuilderInterface $hookFieldsBuilder,
        FormBuilderInterface $adminFormBuilder,
        Module $module
    ) {
        $hookFieldsBuilder
            ->addFields($adminFormBuilder, $module)
            ->add(
                $module->getModuleFormDatasID(), // used to check if datas come from Admin Product form
                'Symfony\Component\Form\Extension\Core\Type\HiddenType',
                ['data' => '1']
            );
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'hookFieldsBuilder' => null,
            'module' => null,
            'allow_extra_fields' => true
        ));
    }
}
