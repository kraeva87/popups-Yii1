<?php

/**
 * Popup class.
 * It is used by the 'popup' action of 'PopupController'.
 */
class Popup extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'popup';
    }
}