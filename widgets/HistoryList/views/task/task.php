<?php
use yii\helpers\Html;

/* @var $user \app\models\User */
/* @var $body string */
/* @var $footer string */
/* @var $footerDatetime string */
/* @var $bodyDatetime string */
/* @var $iconClass string */
?>

<?php echo Html::tag('i', '', ['class' => "icon icon-circle icon-main white $iconClass"]); ?>

<div class="list-group-content">

    <div class="list-group-inner">
        <div class="list-group-body">

            <div class="list-group-message">
                <?php echo $body ?>
            </div>

            <div class="list-group-side">
                <?= $user->username; ?>
            </div>

        </div>
    </div>

    <div class="list-group-footer">
        <?php echo isset($footer) ? $footer : '' ?>
        <?php if (isset($footerDatetime)): ?>
            <span class="list-group-datetime">
                <?= \app\widgets\DateTime\DateTime::widget(['dateTime' => $footerDatetime]) ?>
            </span>
        <?php endif; ?>
    </div>


</div>