## Сайт панель управления электронных книг
<b>Автор:</b> Рустам Артыкбаев<br>
<b>Версия Laravel :</b> 7.0<br>
<b>Версия PHP :</b> 7.4<br>
<b>Версия MySQL :</b> 5.7

### Для запуска сайта необходимо запустить следующие команды:
<b>1.</b>Эта команда добавляет данные в базу данных.
<br>Запустите эту команду <b> в контейнере php (bash)</b>
```
php artisan load:fixtures
```
<b>Данные админа:</b><br>
Login: admin<br>
Password: 12345678

<b>2.</b>Эта команда запускает Unit тесты.
<br>Запустите эту команду <b> в контейнере php (bash)</b>
```
php artisan test
```

<b>Верстку для сайта я брал из учебных кейсов Micros</b><br>
<b>Верстку для админки брал из https://colorlib.com/polygon/sufee/index.html </b><br>
<b>Бекенд сайта и админки делал сам с нуля</b>
