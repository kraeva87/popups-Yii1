<?php

class PopupController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// page action renders "static" pages stored under 'protected/views/popup/pages'
			// They can be accessed via: index.php?r=popup/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/popup/index.php'
		// using the default layout 'protected/views/layouts/main.php'
        //$model = new Popup;
        $popups = Popup::model()->findAll(array(
            'select'=>'*',
        ));

		$this->render('index',array('popups'=>$popups));
	}

    /**
     * Popup form page
     */
    public function actionNew()
    {
        $model = new PopupForm;
        if (isset($_POST['PopupForm'])) {
            $model->attributes = $_POST['PopupForm'];
            if ($model->validate()) {
                $popup = new Popup;
                $popup->title = $model->title;
                $popup->popup_text = $model->popup_text;
                $popup->enabled = $model->enabled;
                $popup->count_show = 0;
                $popup->save();
                Yii::app()->user->setFlash('popup','Your popup was created.');
                $this->refresh();
            }
        }
        $this->render('new',array('model'=>$model));
    }

    /**
     * Edit Popup page
     */
    public function actionEdit($id = 0)
    {
        $model = Popup::model()->findByPk($id);
        if (isset($_POST['PopupForm'])) {
            $model->attributes = $_POST['PopupForm'];
            if ($model->validate()) {
                $popup = Popup::model()->findByPk($id);
                $popup->title = $model->title;
                $popup->popup_text = $model->popup_text;
                $popup->enabled = $model->enabled;
                $popup->save();
                Yii::app()->user->setFlash('popup','Your popup was changed.');
                $this->refresh();
            }
        }
        $this->render('edit',array('model'=>$model));
    }

    /**
     * Delete Popup
     */
    public function actionDelete($id = 0)
    {
        $model = Popup::model()->findByPk($id);
        $model->delete();
        $this->redirect(array('index'));
    }

	/**
	 * Demo page
	 */
	public function actionDemo($id = 0)
	{
        $popup = Popup::model()->findByPk($id);
		$this->render('demo',array('popup'=>$popup));
	}

    /**
     * Get Script page
     */
    public function actionGetScript($id = 0)
    {
        $model = new PopupForm;
        $popup = Popup::model()->findByPk($id);
        $model->url = '<textarea rows="6" cols="100"><script id="custom-popup" src="'.Yii::app()->request->baseUrl.'/assets/js/getpopup.js?popup_id='.$popup->id.'"></script></textarea>';
        $this->render('getscript',array('model'=>$model));
    }

    /**
     * Get Popup By Url
     */
    public function actionGetPopupByScript()
    {
        $result = array();
        $popup_id = 0;
        unset($params);
        if (isset(Yii::app()->request->restParams)) {
            $params = array_keys(Yii::app()->request->restParams);
            $params = json_decode($params[0]);
            if ($params->popup_id) {
                $popup_id = (int)$params->popup_id;
                $popup = Popup::model()->findByPk($popup_id);
                $popup->count_show++;
                $popup->save();
                if ($popup->enabled > 0) {
                    $result['popup_text'] = $popup->popup_text;
                    $result['status'] = 'ok';
                } else $result['status'] = 'error';
            } else $result['status'] = 'error';

        } else $result['status'] = 'error';

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($result);
    }
}