<?php

class ms2DeliveryCostItemCreateProcessor extends modObjectCreateProcessor
{
    public $objectType = 'ms2DeliveryCostItem';
    public $classKey = 'ms2DeliveryCostItem';
    public $languageTopics = ['ms2deliverycost'];
    //public $permission = 'create';


    /**
     * @return bool
     */
    public function beforeSet()
    {
        $name = trim($this->getProperty('name'));
        if (empty($name)) {
            $this->modx->error->addField('name', $this->modx->lexicon('ms2deliverycost_item_err_name'));
        } elseif ($this->modx->getCount($this->classKey, ['name' => $name])) {
            $this->modx->error->addField('name', $this->modx->lexicon('ms2deliverycost_item_err_ae'));
        }

        return parent::beforeSet();
    }

}

return 'ms2DeliveryCostItemCreateProcessor';