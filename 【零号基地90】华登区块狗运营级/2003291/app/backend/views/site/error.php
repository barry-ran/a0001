<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;


echo $this->render("//layouts/errors/error" . $exception->statusCode);




