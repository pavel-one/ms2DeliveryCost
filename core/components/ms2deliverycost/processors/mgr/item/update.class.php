<?php

class ms2DeliveryCostItemUpdateProcessor extends modObjectUpdateProcessor
{
    public $objectType = 'ms2DeliveryCostItem';
    public $classKey = 'ms2DeliveryCostItem';
    public $languageTopics = ['ms2deliverycost'];
    //public $permission = 'save';


    /**
     * We doing special check of permission
     * because of our objects is not an instances of modAccessibleObject
     *
     * @return bool|string
     */
    public function beforeSave()
    {
        if (!$this->checkPermissions()) {
            return $this->modx->lexicon('access_denied');
        }

        return true;
    }


    /**
     * @return bool
     */
    public function beforeSet()
    {
        $id = (int)$this->getProperty('id');
        $name = trim($this->getProperty('name'));
        if (empty($id)) {
            return $this->modx->lexicon('ms2deliverycost_item_err_ns');
        }

        if (empty($name)) {
            $this->modx->error->addField('name', $this->modx->lexicon('ms2deliverycost_item_err_name'));
        } elseif ($this->modx->getCount($this->classKey, ['name' => $name, 'id:!=' => $id])) {
            $this->modx->error->addField('name', $this->modx->lexicon('ms2deliverycost_item_err_ae'));
        }

        return parent::beforeSet();
    }
}

return 'ms2DeliveryCostItemUpdateProcessor';
