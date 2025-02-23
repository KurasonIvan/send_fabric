<?php

namespace app\controllers;

use Yii;
use yii\rest\Controller;
use yii\web\Request;
use yii\web\Response;

class ApiController extends Controller
{
    private const SUCCESS_STATUS = 'success';
    private const ERROR_STATUS = 'error';
    private const SUCCESS_CODE = '200';
    private const UNAUTHORIZED_CODE = '403';
    private const BAD_REQUEST_CODE = '404';
    private const METHOD_NOT_ALLOWED_CODE = '405';

    public array $data = [];
    public Request $request;


    public function beforeAction($action)
    {
        $tokenFromHeaders = Yii::$app->request->headers->get('Authorization');
        $token = 'Bearer ' . Yii::$app->params['apiToken'];
        if ($token !== $tokenFromHeaders) {
            Yii::$app->response->data = [
                'status' => self::ERROR_STATUS,
                'code' => self::UNAUTHORIZED_CODE,
                'message' => 'Invalid token'
            ];
            Yii::$app->response->send();
            return false;
        }

        $this->request = Yii::$app->request;

        return parent::beforeAction($action);
    }
    public function actionSendSms()
    {
    }
}