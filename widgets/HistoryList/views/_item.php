<?php

use app\models\Call;
use app\models\Customer;
use app\models\History;
use app\models\Sms;
use app\widgets\HistoryList\helpers\HistoryListHelper;

/** @var $model \app\models\search\HistorySearch */

echo $this->render($model->eventFactory->renderFileName(), $model->eventFactory->renderParams($model));

 ?>
