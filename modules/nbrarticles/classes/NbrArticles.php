<?php
class NbrArticles extends Module
{
    public function __construct()
    {
        $this->name = 'nbrarticles';
        $this->tab = 'Happy_Module';
        $this->version = '1.0.0';
        $this->author = 'Tibau Meunier';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
        $this->bootstrap = true;
        parent::__construct();

        $this->displayName = $this->l('Nbr Of Articles');
        $this->description = $this->l('Great module.');

        $this->confirmUninstall = $this->l('Do you really want to uninstall that wonderful module ?');

        if (!Configuration::get('NBRARTICLES_NAME')) {
            $this->warning = $this->l('Where is the name mister ? :(');
        }
    }

    public function install()
    {
        if (Shop::isFeatureActive()) {
            Shop::setContext(Shop::CONTEXT_ALL);
        }

        if (!parent::install()
            || !$this->registerHook('leftColumn')
            || !$this->registerHook('header')
            || !Configuration::updateValue('NBRARTICLES_NAME', 'my friend')
        ) {
            return false;
        }
        return true;
    }

    public function hookDisplayLeftColumn($params)
    {
        $productObj = new Product();
        $products = $productObj->getProducts(Context::getContext()->language->id, 0, 0, 'id_product', 'DESC', false, true);
        $total = count($products);
        $this->context->smarty->assign(
            array(
                'nbr_article_total' => $total
                )
        );
        return $this->display(_PS_MODULE_DIR_."nbrarticles/nbrarticles.php", 'nbrarticles.tpl');
    }

    public function hookDisplayHeader()
    {
        $this->context->controller->addCSS($this->_path.'css/nbrarticles.css', 'all');
    }

    public function hookDisplayRightColumn($params)
    {
        return $this->hookDisplayLeftColumn($params);
    }
}
