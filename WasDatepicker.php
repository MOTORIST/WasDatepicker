<?php
class WasDatepicker extends CInputWidget
{
    /**
     * @var TbActiveForm the associated form widget.
     */
    public $form;
    /**
     * @var CModel the data model associated with this widget.
     */
    public $model;
    /**
     * @var string the input label text.
     */
    public $label;
    /**
     * @var string text.
     */
    public $hintText;
    /**
     * @var array error html attributes.
     */
    public $errorOptions;
    /**
     * @var array label html attributes.
     */
    public $labelOptions = array();
    /**
     * @var array hint html attributes.
     */
    public $hintOptions = array();
    /**
     * @var array additional HTML options to be rendered in the input tag
     */
    public $htmlOptions = array();
    /**
     * @var string the attribute associated with this widget.
     * The name can contain square brackets (e.g. 'name[1]') which is used to collect tabular data input.
     */
    public $attribute;
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
        if (!isset($this->form))
            throw new CException(__CLASS__ . ': Failed! Form is not set.');

        if (!isset($this->model))
            throw new CException(__CLASS__ . ': Failed! Model is not set.');

        if (!isset($this->attribute))
            throw new CException(__CLASS__ . ': Failed! Model is not set.');

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
     * Run widget.
     */
    public function run()
    {
        $this->textField();
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

    /**
     * Returns the label for the input.
     * @return string the label
     */
    protected function getLabel()
    {
        if ($this->label !== false)
            return $this->form->labelEx($this->model, $this->attribute, $this->labelOptions);
        else
            return '';
    }

    /**
     * Returns the id that should be used for the specified attribute
     * @param string $attribute the attribute
     * @return string the id
     */
    protected function getAttributeId($attribute)
    {
        return isset($this->htmlOptions['id'])
            ? $this->htmlOptions['id']
            : CHtml::getIdByName(CHtml::resolveName($this->model, $attribute));
    }

    /**
     * Returns the error text for the input.
     * @return string the error text
     */
    protected function getError()
    {
        return $this->form->error($this->model, $this->attribute, $this->errorOptions);
    }

    /**
     * Returns the hint text for the input.
     * @return string the hint text
     */
    protected function getHint()
    {
        if (isset($this->hintText)) {
            $htmlOptions = $this->hintOptions;

            if (isset($htmlOptions['class']))
                $htmlOptions['class'] .= ' help-block';
            else
                $htmlOptions['class'] = 'help-block';

            return CHtml::tag('p', $htmlOptions, $this->hintText);
        } else
            return '';
    }

    /**
     * @return void
     * print textField
     */
    protected function textField()
    {
        echo $this->getLabel();
        echo '<div class="controls">';
        echo $this->form->textField($this->model, $this->attribute, $this->htmlOptions);
        echo $this->getError() . $this->getHint();
        echo '</div>';
    }

}