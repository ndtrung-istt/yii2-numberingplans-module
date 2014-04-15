<?php

namespace vendor\istt\numberingplans;

class NumberingPlansModule extends \yii\base\Module
{
    public $controllerNamespace = 'vendor\istt\numberingplans\controllers';

    public function init()
    {
        parent::init();

        \Yii::$app->getI18n()->translations['*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' => __DIR__ . '/messages',
        ];
    }
}
