<?php
class WasDatepicker extends CInputWidget
{

    /**
     * @var array files for package
     */
    public $package = array();
    /**
     * @var array extension options. For more info read {@link https://github.com/eternicode/bootstrap-datepicker documentation}
     */
    public $options = array();

    /**
     * Initializes the widget.
     */
    public function init()
    {
        list($this->name, $this->id) = $this->resolveNameId();

        if($this->hasModel()) {
            echo CHtml::activeTextField($this->model, $this->attribute, $this->htmlOptions);
        } else {
            $this->htmlOptions['id'] = $this->id;
            echo CHtml::textField($this->name, $this->value, $this->htmlOptions);
        }

        if (isset($this->options['language'])) {
            $language = 'locales/bootstrap-datepicker.' . $this->options['language'] . '.js';
        } else $language = '';

        $this->package = array(
            'basePath' => dirname(__FILE__) . '/files',
            'js' => array(
                'bootstrap-datepicker.js',
                $language
            ),
            'css' => array(
                'datepicker.css',
            ),
        );

        if (!isset($this->package['baseUrl'])) {
            $this->package['baseUrl'] = Yii::app()->getAssetManager()->publish($this->package['basePath'], false, -1, YII_DEBUG);
        }

        $this->registerClientScript();
    }

    /**
     * @return void
     * Register JS and CSS.
     */
    protected function registerClientScript()
    {
        $cs = Yii::app()->getClientScript();
        $cs->packages['Datepicker'] = $this->package;
        $cs->registerPackage('Datepicker');
        $js = '$("#' . $this->id . '").datepicker(' . CJavaScript::encode($this->options) . ')';
        $cs->registerScript(__CLASS__ . '#' . $this->id, $js, CClientScript::POS_READY);
    }

}