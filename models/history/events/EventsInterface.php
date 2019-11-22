<?php
namespace app\models\history\events;



use app\models\history\History;

/**
 * Interface BannerInterface
 * @package common\models\banner
 */
interface EventsInterface
{
    public function renderFileName() : string;
    public function renderParams(History $model) : array;
    public function getBody(History $model) : string;
}