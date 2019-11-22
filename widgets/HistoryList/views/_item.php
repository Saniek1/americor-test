<?php

use app\models\Call;
use app\models\Customer;
use app\models\History;
use app\models\Sms;
use app\widgets\HistoryList\helpers\HistoryListHelper;

/** @var $model \app\models\search\HistorySearch */

$event = \app\models\history\events\EventsFactory::factory($model);

echo $this->render($event->renderFileName(), $event->renderParams($model));

 ?>
