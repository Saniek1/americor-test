<p align="center">
    <h1 align="center">Тестовое задание компании Americor <br> на должность Yii разработчика.</h1>
    <br>
</p>

Функционал в проекте - это вывод ленты истории действий над объектами с возможностью экспорта. 

1. Сделать копию репозитария.
2. Отрефакторить код для вывода ленты истории и экпорта. Предложить архитектурное решение, такое чтобы его удобно было в поддерживать в дальнейшем с учетом роста количества событий и объектов. 
3. Прислать ссылку на ваш репозитарий в личном сообщении.

Готовы принять ваше решение задачи в виде словесного описания.

<h3>Что я сделал, в двух словах</h3>
Для каждого события сделал отдельный класс и отдельное view.<br>
Добавил фабрику событий, при выводе получаем тип события, инициализируем класс события и выводим.

