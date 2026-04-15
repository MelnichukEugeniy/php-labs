<div class="page-home">
    <h1>Магазин мотоциклів</h1>
    <p class="page-home__subtitle">Варіант 13 &mdash; Лабораторна робота №5</p>
    <p class="text-muted">Магазин мотоциклів та запчастин. Гостьова книга клієнтів, галерея фото, CRUD мотоциклів через PDO, авторизація.</p>

    <h2>Файли</h2>
    <div class="card-grid">
        <div class="card">
            <h3 class="card__title">Коментарі клієнтів</h3>
            <p class="card__text">Залишайте відгуки про мотоцикли та сервіс. Коментарі зберігаються у текстовому файлі.</p>
            <a href="index.php?route=guestbook/index" class="btn btn--small">Відгуки</a>
        </div>

        <div class="card">
            <h3 class="card__title">Галерея мотоциклів</h3>
            <p class="card__text">Завантажуйте фото мотоциклів та запчастин. Галерея транспортних засобів.</p>
            <a href="index.php?route=upload/index" class="btn btn--small">Галерея</a>
        </div>

        <div class="card">
            <h3 class="card__title">Кабінети механіків</h3>
            <p class="card__text">Персональні папки для механіків з проектами, послугами та запчастинами.</p>
            <a href="index.php?route=folder/create" class="btn btn--small">Кабінети</a>
        </div>
    </div>

    <h2>База даних</h2>
    <div class="card-grid">
        <div class="card">
            <h3 class="card__title">Каталог мотоциклів (CRUD)</h3>
            <p class="card__text">Колекція мотоциклів з характеристиками, цінами та описами. PDO + SQLite.</p>
            <a href="index.php?route=motorcycle/list" class="btn btn--small">До мотоциклів</a>
        </div>

        <div class="card">
            <h3 class="card__title">Акаунт клієнта</h3>
            <p class="card__text">Реєстрація, вхід, профіль. Хешування паролів, сесійна авторизація.</p>
            <a href="index.php?route=auth/login" class="btn btn--small">Увійти</a>
        </div>

        <div class="card">
            <h3 class="card__title">Налаштування</h3>
            <p class="card__text">Колір фону (сесія) та привітання (cookie). Успадковано з ЛР4.</p>
            <a href="index.php?route=settings/color" class="btn btn--small">Налаштування</a>
        </div>
    </div>
</div>
