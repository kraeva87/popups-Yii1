<?php

/**
 * PopupForm class.
 * PopupForm is the data structure for keeping
 * popup form data. It is used by the 'popup' action of 'PopupController'.
 */
class PopupForm extends CFormModel
{
	public $title;
	public $popup_text;
	public $enabled;
    public $url;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// title, popup_text and enabled are required
			array('title, popup_text, enabled', 'required'),
		);
	}
}