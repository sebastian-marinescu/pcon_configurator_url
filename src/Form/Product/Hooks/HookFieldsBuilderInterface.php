<?php
    
    namespace PrestaShop\Module\PconConfiguratorUrl\Form\Product\Hooks;

    use Symfony\Component\Form\FormBuilderInterface;
    use Module;
    
    interface HookFieldsBuilderInterface
    {
        public function addFields(FormBuilderInterface $adminFormBuilder, Module $module) : FormBuilderInterface;
    }
