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
 
У всех пользователей [один пароль](https://github.com/steqtk/larablog/blob/master/database/factories/UserFactory.php).
 
Main screen
![ScreenShot](https://raw.github.com/steqtk/larablog/master/screenshot.png)
Screen after login with icons for editing / deleting your posts
![ScreenShot](https://raw.github.com/steqtk/larablog/master/screenshot1.png)
Screen for editing your post.
![ScreenShot](https://raw.github.com/steqtk/larablog/master/screenshot2.png)
