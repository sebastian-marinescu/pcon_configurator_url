<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

require_once __DIR__.'/vendor/autoload.php';

use PrestaShop\Module\PconConfiguratorUrl\Form\Product\Hooks\HookFieldsBuilderInterface;
use PrestaShop\Module\PconConfiguratorUrl\Form\Product\Hooks\HookFieldsBuilderFinder;
use PrestaShop\Module\PconConfiguratorUrl\Form\Product\PconConfiguratorUrlAdminForm;
use PrestaShop\Module\PconConfiguratorUrl\Form\Product\ProductFormDataHandler;
use PrestaShop\PrestaShop\Adapter\SymfonyContainer;

class PconConfiguratorUrl extends Module
{
    private $symfonyInstance = null;
    private $productFormDataHandler;
        
    public function __construct()
    {
        $this->name = 'pcon_configurator_url';
        $this->tab = 'administration';
        $this->version = '1.0.0';
        $this->author = 'Sebastian G. Marinescu';
        $this->need_instance = 1;

        parent::__construct();

        $this->displayName = $this->l('pCon.UI Configurator-URL for Prestashop 1.7');
        $this->description = $this->l('Custom product-field for Prestashop 1.7 to specify a pCon.ui configurator');

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall the module?');

        $this->ps_versions_compliancy = array('min' => '1.7', 'max' => _PS_VERSION_);
        $this->productFormDataHandler = new ProductFormDataHandler();
    }
    
    public function isUsingNewTranslationSystem()
    {
        return true;
    }

    public function install()
    {
        include(dirname(__FILE__).'/sql/install.php');

        return parent::install() && $this->registerHook($this->getHooks());
    }

    public function uninstall()
    {
        include(dirname(__FILE__).'/sql/uninstall.php');

        return parent::uninstall();
    }

    public function __call($hookName, $params) {
        $hookFieldsBuilder = (new HookFieldsBuilderFinder())->find($hookName);

        if (null != $hookFieldsBuilder){
            return $this->displayProductAdminHookFields($hookFieldsBuilder, $params);
        }
    }

    public function hookActionGetProductPropertiesAfter($params)
    {
        $productCustomsData = $this->productFormDataHandler->getData(
            [
                'id_product' => (int) $params['product']['id_product'],
                'id_lang' => $this->context->language->id,
                'id_shop' => $this->context->shop->id
            ]
        );

        $params['product'][$this->name] = $productCustomsData;
    }
    
    public function hookActionAdminProductsControllerSaveAfter($params)
    {
        $data = Tools::getValue($this->name);

        if (!is_array($data) || !isset($data[$this->getModuleFormDatasID()])) { // Make sure data come from this form
            return;
        }

        if(!isset($data['id_product'])) {
            $data['id_product'] = (int) Tools::getValue('id_product');
        }

        $this->productFormDataHandler->save($data);
    }
    
    public function symfonyContainerInstance()
    {
        if (null != $this->symfonyInstance) {
            return $this->symfonyInstance;
        }
        
        $this->symfonyInstance = SymfonyContainer::getInstance();
        
        return $this->symfonyInstance;
    }
    
    private function getProductAdminHookFieldsDefinition(HookFieldsBuilderInterface $hookFieldsBuilder, array $data)
    {
        $formFactory = $this->symfonyContainerInstance()->get('form.factory');
        $options = [
            'csrf_protection' => false,
            'hookFieldsBuilder' => $hookFieldsBuilder,
            'module' => $this,
        ];

        return $formFactory->createNamed($this->name, PconConfiguratorUrlAdminForm::class, $data, $options);
    }
    
    private function displayProductAdminHookFields(HookFieldsBuilderInterface $hookFieldsBuilder, array $params)
    {
        if (!isset($params['id_product'])){
            $requestStack = $this->symfonyContainerInstance()->get('request_stack');
            $request = $requestStack->getCurrentRequest();
            $params['id_product'] = (int) $request->attributes->get('id');
        }

        $productFieldsData = $this->productFormDataHandler->getData($params);
        $form = $this->getProductAdminHookFieldsDefinition($hookFieldsBuilder, $productFieldsData);

        return $this->symfonyContainerInstance()
            ->get('twig')
            ->render('@PrestaShop/'.$this->name.'/admin/product/configurator_url.html.twig', [
                'form' => $form->createView(),
            ]);
    }
    
    public function getHooks()
    {
        // @see https://devdocs.prestashop.com/1.7/modules/concepts/hooks/list-of-hooks/#full-list
        return [
            'displayAdminProductsMainStepLeftColumnBottom',
            'actionAdminProductsControllerSaveAfter',
            'actionObjectProductDeleteAfter',
            'actionGetProductPropertiesAfter'
        ];
    }
    
    public function getLocales()
    {
        $sfContainer = $this->symfonyContainerInstance();
        return $sfContainer->get('prestashop.adapter.data_provider.language')->getLanguages();
    }
    
    public function getModuleFormDatasID()
    {
        return 'fields_from_'.$this->name.'_'.$this->id ;
    }
}
