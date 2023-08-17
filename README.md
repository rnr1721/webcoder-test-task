# webcoder-test-task
Test task for Junior PHP developer vacancy

## What need to do?

1. Есть страница с формой "добавить нового сотрудника".
Поля для формы:
- email - уникальное значение
- имя пользователя
- адрес пользователя
- телефон
- комментарии
- отдел (выбор из другой сущности)

2. Есть страница отделы. Там список существующих отделов с возможностью добавить новый и удалить. Все очень просто. 1 поле "название". Название уникальное

3. Есть страница "все пользователи" со списком всех этих пользователей , и их отделами. по клику на выбранного переходим на страницу детального просмотра.

4. Нужно создать роуты, чтоб использовать адекватные ЧПУ.
Ссылки у всех этих страниц должны быть не index.php, user.php?id=1б а например app.loc/users , app.loc/add-user, app.loc/user/1
Условия выполнения:
- это должно быть MVC
- в отдельном файле должны быть настройки подключения к БД
- должны быть адекватные роуты с ЧПУ
- не использовать готовых ЦМС
- не использовать фреймворков
- всю историю реализации хотелось бы увидеть в гите (не один финальный коммит "код", а шаг за шагом)
- для фронтенда можете использовать bootstrap

## requirements

- Apache or Nginx web server
- PHP 8.1
- MySQL or MariaDB
- composer

## Installation

1. Clone the repo.
2. Set up your server to access ./public directory of project
3. import your database from webcoder_task.sql file. Set up database in ./config/db.php
4. run "composer update" to set up autoloading
5. Run tests by "composer test" command
6. Thats all!
