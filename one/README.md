# test.zakupki.com.ua2

* 1. Настройка
	* Сколнировать исходный код
	* Прописать настйроки соединения с БД
	* Выполнить миграции
	* Выполить seeder

В проекте есть 2 страницы досутпные из верхнего меню. Страница со списком пользователей и списком продуктов.

Задание:

1. Изменить содержимое метатега title на странице со списком продуктов.

2. Реализовать кнопку загрузки изображения как для пользователя так и для продукта.

    * а) Необходимо создать контроллер который будет обрабатывать форму загрузки изображения, а так же шаблон с формой загрузки. Форма должна содержать текстовое поле "название изображения" и поле с загрузкой файла.
    * б) Сделать валидацию и позовлять загружать только файлы формата JPEG, в противном случае выводить сообщение о недопустимом формате.
    * б) Сделать миграцию по созданию таблицы со списком изображений.
    * г) Создать модель описывающую таблицу и добавить связь с моделями пользователя и продукта.
    * д) Вывести на страницах со списком пользователй и продуктов перечень изображений. В колонке "изображения" должны быть ссылки вида <a hre="{{path}}">{{name}}</a>

Примечание: таблица и модель должна быть одна, но должна быть связана как с моделью пользователя так и с моделью продукта.