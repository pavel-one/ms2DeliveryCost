<?php

class ms2DeliveryCostItemDisableProcessor extends modObjectProcessor
{
    public $objectType = 'ms2DeliveryCostItem';
    public $classKey = 'ms2DeliveryCostItem';
    public $languageTopics = ['ms2deliverycost'];
    //public $permission = 'save';


    /**
     * @return array|string
     */
    public function process()
    {
        if (!$this->checkPermissions()) {
            return $this->failure($this->modx->lexicon('access_denied'));
        }

        $ids = $this->modx->fromJSON($this->getProperty('ids'));
        if (empty($ids)) {
            return $this->failure($this->modx->lexicon('ms2deliverycost_item_err_ns'));
        }

        foreach ($ids as $id) {
            /** @var ms2DeliveryCostItem $object */
            if (!$object = $this->modx->getObject($this->classKey, $id)) {
                return $this->failure($this->modx->lexicon('ms2deliverycost_item_err_nf'));
            }

            $object->set('active', false);
            $object->save();
        }

        return $this->success();
    }

}

return 'ms2DeliveryCostItemDisableProcessor';
