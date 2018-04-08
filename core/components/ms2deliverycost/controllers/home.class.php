<?php

/**
 * The home manager controller for ms2DeliveryCost.
 *
 */
class ms2DeliveryCostHomeManagerController extends modExtraManagerController
{
    /** @var ms2DeliveryCost $ms2DeliveryCost */
    public $ms2DeliveryCost;


    /**
     *
     */
    public function initialize()
    {
        $this->ms2DeliveryCost = $this->modx->getService('ms2DeliveryCost', 'ms2DeliveryCost', MODX_CORE_PATH . 'components/ms2deliverycost/model/');
        parent::initialize();
    }


    /**
     * @return array
     */
    public function getLanguageTopics()
    {
        return ['ms2deliverycost:default'];
    }


    /**
     * @return bool
     */
    public function checkPermissions()
    {
        return true;
    }


    /**
     * @return null|string
     */
    public function getPageTitle()
    {
        return $this->modx->lexicon('ms2deliverycost');
    }


    /**
     * @return void
     */
    public function loadCustomCssJs()
    {
        $this->addCss($this->ms2DeliveryCost->config['cssUrl'] . 'mgr/main.css');
        $this->addJavascript($this->ms2DeliveryCost->config['jsUrl'] . 'mgr/ms2deliverycost.js');
        $this->addJavascript($this->ms2DeliveryCost->config['jsUrl'] . 'mgr/misc/utils.js');
        $this->addJavascript($this->ms2DeliveryCost->config['jsUrl'] . 'mgr/misc/combo.js');
        $this->addJavascript($this->ms2DeliveryCost->config['jsUrl'] . 'mgr/widgets/items.grid.js');
        $this->addJavascript($this->ms2DeliveryCost->config['jsUrl'] . 'mgr/widgets/items.windows.js');
        $this->addJavascript($this->ms2DeliveryCost->config['jsUrl'] . 'mgr/widgets/home.panel.js');
        $this->addJavascript($this->ms2DeliveryCost->config['jsUrl'] . 'mgr/sections/home.js');

        $this->addHtml('<script type="text/javascript">
        ms2DeliveryCost.config = ' . json_encode($this->ms2DeliveryCost->config) . ';
        ms2DeliveryCost.config.connector_url = "' . $this->ms2DeliveryCost->config['connectorUrl'] . '";
        Ext.onReady(function() {MODx.load({ xtype: "ms2deliverycost-page-home"});});
        </script>');
    }


    /**
     * @return string
     */
    public function getTemplateFile()
    {
        $this->content .= '<div id="ms2deliverycost-panel-home-div"></div>';

        return '';
    }
}