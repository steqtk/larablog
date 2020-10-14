<h3>LaraBlog</h3>
<ul>
<li>Небольшой пример реализации ленты сообщений различных авторов с ajax-подгрузкой последующих сообщений при прокрутке.</li>
<li>Возможность просмотра изображений в fancybox`e, редактирования своих сообщений, текста, картинок.</li>
</ul>

<ol>
<li>клонируйте проект</li>
<li>в .env задать подключение к БД</li>
<li>composer install</li>
<li>php artisan key:generate</li>
<li>php artisan migrate --seed</li>
 </ol>
 
 У всех пользователей один пароль см. database/factories/UserFactory.php.<br>
 
![ScreenShot](https://raw.github.com/steqtk/larablog/master/screenshot.png)
![ScreenShot](https://raw.github.com/steqtk/larablog/master/screenshot1.png)
![ScreenShot](https://raw.github.com/steqtk/larablog/master/screenshot2.png)
