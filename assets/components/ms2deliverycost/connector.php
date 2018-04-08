<?php
if (file_exists(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php')) {
    /** @noinspection PhpIncludeInspection */
    require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php';
} else {
    require_once dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/config.core.php';
}
/** @noinspection PhpIncludeInspection */
require_once MODX_CORE_PATH . 'config/' . MODX_CONFIG_KEY . '.inc.php';
/** @noinspection PhpIncludeInspection */
require_once MODX_CONNECTORS_PATH . 'index.php';
/** @var ms2DeliveryCost $ms2DeliveryCost */
$ms2DeliveryCost = $modx->getService('ms2DeliveryCost', 'ms2DeliveryCost', MODX_CORE_PATH . 'components/ms2deliverycost/model/');
$modx->lexicon->load('ms2deliverycost:default');

// handle request
$corePath = $modx->getOption('ms2deliverycost_core_path', null, $modx->getOption('core_path') . 'components/ms2deliverycost/');
$path = $modx->getOption('processorsPath', $ms2DeliveryCost->config, $corePath . 'processors/');
$modx->getRequest();

/** @var modConnectorRequest $request */
$request = $modx->request;
$request->handleRequest([
    'processors_path' => $path,
    'location' => '',
]);