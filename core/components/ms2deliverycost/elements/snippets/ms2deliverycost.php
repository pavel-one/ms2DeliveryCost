<?php
/* 
Принимает на вход два параметра:
tpl - чанк вывода
cost - сумма заказа, если расчет нужно делать с учетом всего заказа
jsPath - путь до кастомного js
required - необходимые поля для перезагрузки методов доставки (через запятую)
*/
if (!$miniShop2 = $modx->getService('miniShop2')) {
    return ;
}
if (!$pdo = $modx->getService('pdoTools')) {
    return ;
}
if (!$cost) {
    $cost = 0;
}
if (!$tpl) {
	$tpl = 'tpl.ms2DeliveryCost';
}
if (!$jsPath) {
    $jsPath = MODX_ASSETS_URL.'components/ms2deliverycost/js/web/default.js';
}
if (!$required) {
    $required = 'city,index';
} else {
    $required = str_replace(' ', '', $required); 
}

$modx->regClientScript($jsPath);
$modx->regClientHTMLBlock('
    <script>
        if (typeof(ms2DeliveryCost) != "object") {
            var ms2DeliveryCost = {};
        }
        ms2DeliveryCost.required = "'.$required.'";
    </script>
');

$q = $modx->newQuery('msDelivery');
$q->where(array(
    'active' => 1,    
));
$q->sortby('rank', 'ASC');
$col = $modx->getCollection('msDelivery', $q);
$order = $miniShop2->order;

$out = array('costs' => array(), 'order' => array());

foreach ($col as $delivery) {
    $paymentsArr = array();
    $payments = $delivery->getMany('Payments');
    foreach($payments as $item) {
        $paymentsArr[] = $item->get('payment_id');
    }
    
    if ($_GET['deliveryGetCost'] == 'get') {
        $costDelivery = $delivery->getCost($order, $cost);
    } else {
        $costDelivery = false;
    }
    
    $out['costs'][] = array(
        'cost' => $costDelivery,
        'delivery' => $delivery->toArray(),
        'payments' => $paymentsArr,
    );
}
$out['order'] = $order->get();
return $pdo->getChunk($tpl, $out);