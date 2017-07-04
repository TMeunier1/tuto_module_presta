<?php
class MyModule extends Module
{
    public function __construct() 
    {
        $this->name = 'mymodule';
        $this->tab = 'Joyeux_Module';
        $this->version = '1.0.0';
        $this->author = 'Tibau Meunier';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
        $this->bootstrap = true;
        parent::__construct();

        $this->displayName = $this->l('Mon module');
        $this->description = $this->l('Merveilleux module.');

        $this->confirmUninstall = $this->l('Désinstalles pas gros on est bien');

        if (!Configuration::get('MYMODULE_NAME')) {
            $this->warning = $this->l('Y\'a pas de nom kefa ?!');
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
            || !Configuration::updateValue('MYMODULE_NAME', 'my friend')
        ) {
            return false;
        }
        return true;
    }

    public function uninstall() 
    {
        if (!parent::uninstall()) {
            return false;
        }
        return true;
    }
}
