Autor(bootstrap-datepicker) Stefan Petre's [original code](http://www.eyecon.ro/bootstrap-datepicker/)

WasDatepicker (bootstrap)
=============

## Datepicker for yii

```php

<?php $form=$this->beginWidget('CActiveForm',array(
	'id'=>'test,

)); ?>

<?php
       $this->widget('application.components.was.WasDatepicker',array(
           'model'=>$model,
           'form'=>$form,
           'attribute'=>'create_time',
           'options'=>array(
               'language'=>'ru',
               'format'=>'dd.mm.yyyy',
               'autoclose'=>'true',
               'startDate'=>'3,9,2012',
               'endDate'=>'15,9,2012',
               'weekStart'=>1,
               'startView'=>2,
               'keyboardNavigation'=>true
            ),
            'htmlOptions'=>array(
               'value'=>date("d.m.Y"),
             ),
      ));
?>

<?php $this->endWidget(); ?>

```

## Options

All options that take a "Date" can handle a `Date` object; a String formatted according to the given `format`; or a timedelta relative to today, eg '-1d', '+6m +1y', etc, where valid units are 'd' (day), 'w' (week), 'm' (month), and 'y' (year).

### format

String.  Default: 'mm/dd/yyyy'

The date format, combination of d, dd, m, mm, M, MM, yy, yyyy.

### weekStart

Integer.  Default: 0

Day of the week start. 0 (Sunday) to 6 (Saturday)

### startDate

Date.  Default: Beginning of time

The earliest date that may be selected; all earlier dates will be disabled.

### endDate

Date.  Default: End of time

The latest date that may be selected; all later dates will be disabled.

### autoclose

Boolean.  Default: false

Whether or not to close the datepicker immediately when a date is selected.

### startView

Number, String.  Default: 0, 'month'

The view that the datepicker should show when it is opened.  Accepts values of 0 or 'month' for month view (the default), 1 or 'year' for the 12-month overview, and 2 or 'decade' for the 10-year overview.  Useful for date-of-birth datepickers.

### keyboardNavigation

Boolean.  Default: true

Whether or not to allow date navigation by arrow keys.

### language

String.  Default: 'en'

The two-letter code of the language to use for month and day names.  These will also be used as the input's value (and subsequently sent to the server in the case of form submissions).  Currently ships with English ('en'), German ('de'), Brazilian ('br'), and Spanish ('es') translations, but others can be added (see I18N below).  If an unknown language code is given, English will be used.
