<h3>LaraBlog</h3>
* Небольшой пример реализации ленты сообщений различных авторов с ajax-подгрузкой последующих сообщений при прокрутке.
*  Сообщение - автор, время, картинка с возможностью просмотра в fancybox`e, сам текст. По внешнему виду - что-то вроде телеграма.

<ol>
<li>клонируйте проект</li>
<li>в .env задать подключение к БД</li>
<li>composer install</li>
<li>php artisan key:generate</li>
<li>php artisan migrate --seed</li>
 </ol>
 
 У всех пользователей один пароль см. database/factories/UserFactory.php.<br>
 
