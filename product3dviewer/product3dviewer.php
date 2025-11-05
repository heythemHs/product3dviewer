<?php
/**
 * Product 3D Viewer Module for PrestaShop 8
 *
 * @author    Claude AI
 * @copyright 2025
 * @license   AFL - Academic Free License (AFL 3.0)
 */

if (!defined('_PS_VERSION_')) {
    exit;
}

class Product3DViewer extends Module
{
    public function __construct()
    {
        $this->name = 'product3dviewer';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Your Name';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = [
            'min' => '8.0.0',
            'max' => _PS_VERSION_
        ];
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Product 3D Viewer');
        $this->description = $this->l('Display interactive 3D product models on your store front page and product pages.');
        $this->confirmUninstall = $this->l('Are you sure you want to uninstall this module?');
    }

    /**
     * Install module and register hooks
     */
    public function install()
    {
        if (!parent::install()
            || !$this->registerHook('displayHome')
            || !$this->registerHook('displayHeader')
            || !$this->registerHook('displayProductAdditionalInfo')
            || !Configuration::updateValue('PRODUCT3D_ENABLED', 1)
            || !Configuration::updateValue('PRODUCT3D_TITLE', 'Explore Our Products in 3D')
            || !Configuration::updateValue('PRODUCT3D_SUBTITLE', 'Rotate, zoom, and view products from every angle')
            || !Configuration::updateValue('PRODUCT3D_AUTO_ROTATE', 1)
            || !Configuration::updateValue('PRODUCT3D_CAMERA_CONTROLS', 1)
        ) {
            return false;
        }

        return true;
    }

    /**
     * Uninstall module and remove configuration
     */
    public function uninstall()
    {
        if (!parent::uninstall()
            || !Configuration::deleteByName('PRODUCT3D_ENABLED')
            || !Configuration::deleteByName('PRODUCT3D_TITLE')
            || !Configuration::deleteByName('PRODUCT3D_SUBTITLE')
            || !Configuration::deleteByName('PRODUCT3D_AUTO_ROTATE')
            || !Configuration::deleteByName('PRODUCT3D_CAMERA_CONTROLS')
        ) {
            return false;
        }

        return true;
    }

    /**
     * Load the configuration form
     */
    public function getContent()
    {
        $output = '';

        if (Tools::isSubmit('submit' . $this->name)) {
            $output .= $this->postProcess();
        }

        $this->context->smarty->assign('module_dir', $this->_path);
        $output .= $this->renderForm();

        return $output;
    }

    /**
     * Save form data
     */
    protected function postProcess()
    {
        Configuration::updateValue('PRODUCT3D_ENABLED', Tools::getValue('PRODUCT3D_ENABLED'));
        Configuration::updateValue('PRODUCT3D_TITLE', Tools::getValue('PRODUCT3D_TITLE'));
        Configuration::updateValue('PRODUCT3D_SUBTITLE', Tools::getValue('PRODUCT3D_SUBTITLE'));
        Configuration::updateValue('PRODUCT3D_AUTO_ROTATE', Tools::getValue('PRODUCT3D_AUTO_ROTATE'));
        Configuration::updateValue('PRODUCT3D_CAMERA_CONTROLS', Tools::getValue('PRODUCT3D_CAMERA_CONTROLS'));

        return $this->displayConfirmation($this->l('Settings updated successfully.'));
    }

    /**
     * Create the configuration form
     */
    protected function renderForm()
    {
        $helper = new HelperForm();

        $helper->show_toolbar = false;
        $helper->table = $this->table;
        $helper->module = $this;
        $helper->default_form_language = $this->context->language->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG', 0);

        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submit' . $this->name;
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false)
            . '&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');

        $helper->tpl_vars = [
            'fields_value' => $this->getConfigFormValues(),
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id,
        ];

        return $helper->generateForm([$this->getConfigForm()]);
    }

    /**
     * Create the structure of configuration form
     */
    protected function getConfigForm()
    {
        return [
            'form' => [
                'legend' => [
                    'title' => $this->l('Settings'),
                    'icon' => 'icon-cogs',
                ],
                'input' => [
                    [
                        'type' => 'switch',
                        'label' => $this->l('Enable 3D Viewer'),
                        'name' => 'PRODUCT3D_ENABLED',
                        'is_bool' => true,
                        'desc' => $this->l('Enable or disable the 3D viewer on your store'),
                        'values' => [
                            [
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->l('Enabled')
                            ],
                            [
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->l('Disabled')
                            ]
                        ],
                    ],
                    [
                        'col' => 3,
                        'type' => 'text',
                        'prefix' => '<i class="icon icon-tag"></i>',
                        'desc' => $this->l('Enter the main title for the 3D viewer section'),
                        'name' => 'PRODUCT3D_TITLE',
                        'label' => $this->l('Section Title'),
                    ],
                    [
                        'col' => 3,
                        'type' => 'text',
                        'prefix' => '<i class="icon icon-pencil"></i>',
                        'desc' => $this->l('Enter the subtitle or description'),
                        'name' => 'PRODUCT3D_SUBTITLE',
                        'label' => $this->l('Section Subtitle'),
                    ],
                    [
                        'type' => 'switch',
                        'label' => $this->l('Auto Rotate'),
                        'name' => 'PRODUCT3D_AUTO_ROTATE',
                        'is_bool' => true,
                        'desc' => $this->l('Automatically rotate 3D models'),
                        'values' => [
                            [
                                'id' => 'rotate_on',
                                'value' => 1,
                                'label' => $this->l('Yes')
                            ],
                            [
                                'id' => 'rotate_off',
                                'value' => 0,
                                'label' => $this->l('No')
                            ]
                        ],
                    ],
                    [
                        'type' => 'switch',
                        'label' => $this->l('Camera Controls'),
                        'name' => 'PRODUCT3D_CAMERA_CONTROLS',
                        'is_bool' => true,
                        'desc' => $this->l('Allow users to control camera (zoom, rotate, pan)'),
                        'values' => [
                            [
                                'id' => 'controls_on',
                                'value' => 1,
                                'label' => $this->l('Yes')
                            ],
                            [
                                'id' => 'controls_off',
                                'value' => 0,
                                'label' => $this->l('No')
                            ]
                        ],
                    ],
                ],
                'submit' => [
                    'title' => $this->l('Save'),
                ],
            ],
        ];
    }

    /**
     * Get current configuration values
     */
    protected function getConfigFormValues()
    {
        return [
            'PRODUCT3D_ENABLED' => Configuration::get('PRODUCT3D_ENABLED', true),
            'PRODUCT3D_TITLE' => Configuration::get('PRODUCT3D_TITLE', 'Explore Our Products in 3D'),
            'PRODUCT3D_SUBTITLE' => Configuration::get('PRODUCT3D_SUBTITLE', 'Rotate, zoom, and view products from every angle'),
            'PRODUCT3D_AUTO_ROTATE' => Configuration::get('PRODUCT3D_AUTO_ROTATE', true),
            'PRODUCT3D_CAMERA_CONTROLS' => Configuration::get('PRODUCT3D_CAMERA_CONTROLS', true),
        ];
    }

    /**
     * Add CSS and JS to header
     */
    public function hookDisplayHeader()
    {
        if (Configuration::get('PRODUCT3D_ENABLED')) {
            $this->context->controller->registerStylesheet(
                'product3dviewer-style',
                'modules/' . $this->name . '/views/css/product3dviewer.css',
                [
                    'media' => 'all',
                    'priority' => 150,
                ]
            );

            $this->context->controller->registerJavascript(
                'model-viewer',
                'https://ajax.googleapis.com/ajax/libs/model-viewer/3.3.0/model-viewer.min.js',
                [
                    'attributes' => 'type="module"',
                    'priority' => 150,
                ]
            );

            $this->context->controller->registerJavascript(
                'product3dviewer-script',
                'modules/' . $this->name . '/views/js/product3dviewer.js',
                [
                    'priority' => 150,
                ]
            );
        }
    }

    /**
     * Display 3D viewer on home page
     */
    public function hookDisplayHome()
    {
        if (!Configuration::get('PRODUCT3D_ENABLED')) {
            return '';
        }

        $this->context->smarty->assign([
            'title' => Configuration::get('PRODUCT3D_TITLE'),
            'subtitle' => Configuration::get('PRODUCT3D_SUBTITLE'),
            'auto_rotate' => Configuration::get('PRODUCT3D_AUTO_ROTATE'),
            'camera_controls' => Configuration::get('PRODUCT3D_CAMERA_CONTROLS'),
            'module_dir' => $this->_path,
        ]);

        return $this->display(__FILE__, 'views/templates/hook/product3dviewer.tpl');
    }

    /**
     * Display 3D viewer on product page
     */
    public function hookDisplayProductAdditionalInfo($params)
    {
        if (!Configuration::get('PRODUCT3D_ENABLED')) {
            return '';
        }

        // Check if product has a 3D model (you can customize this logic)
        $this->context->smarty->assign([
            'auto_rotate' => Configuration::get('PRODUCT3D_AUTO_ROTATE'),
            'camera_controls' => Configuration::get('PRODUCT3D_CAMERA_CONTROLS'),
            'module_dir' => $this->_path,
        ]);

        return $this->display(__FILE__, 'views/templates/hook/product3d_single.tpl');
    }
}
