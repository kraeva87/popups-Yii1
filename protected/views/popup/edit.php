<?php
/* @var $this PopupController */
/* @var $model PopupForm */
/* @var $form CActiveForm */

$this->pageTitle=Yii::app()->name . ' - Edit Popup';
$this->breadcrumbs=array(
	'Popup',
);
?>

<h1>Редактирование попапа</h1>

<?php if(Yii::app()->user->hasFlash('popup')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('popup'); ?>
</div>

<?php else: ?>


<div class="form">

<?php $form = $this->beginWidget('CActiveForm', array(
	'id'=>'edit-popup-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Поля со <span class="required">*</span> обязательны к заполнению.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'Название'); ?>
		<?php echo $form->textField($model,'title'); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Текст попапа'); ?>
		<?php echo $form->textArea($model,'popup_text',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'popup_text'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Включено'); ?>
		<?php echo $form->dropDownList($model,'enabled',array('0' => 'выключено', '1' => 'включено')); ?>
		<?php echo $form->error($model,'enabled'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php endif; ?>