<?php

namespace funson86\blog;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'funson86\blog\controllers\frontend';

    protected $_isBackend;

    public function init()
    {
        parent::init();

        if ($this->getIsBackend() === true) {
            $this->setViewPath('@funson86/yii2-blog/views/backend');
        } else {
            $this->setViewPath('@funson86/yii2-blog/views/frontend');
        }
    }

    /**
     * Check if module is used for backend application.
     *
     * @return boolean true if it's used for backend application
     */
    public function getIsBackend()
    {
        if ($this->_isBackend === null) {
            $this->_isBackend = strpos($this->controllerNamespace, 'backend') === false ? false : true;
        }

        return $this->_isBackend;
    }
}
