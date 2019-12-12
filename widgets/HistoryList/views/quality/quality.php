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
                <?php if (isset($bodyDatetime)) : ?>
                    <span class="list-group-datetime">
                        <?= \app\widgets\DateTime\DateTime::widget(['dateTime' => $bodyDatetime]) ?>
                    </span>
                <?php endif; ?>
            </div>

            <?php if (isset($user)): ?>
                <div class="list-group-side">
                    <?= $user->username; ?>
                </div>
            <?php endif; ?>

        </div>
    </div>

</div>