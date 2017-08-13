разворачиваем проект следующим образом
composer create-project sergalas/yii2-test-basic

завершаем миграции кроме основых установленных  этим dektrium/yii2-user и этим  dektrium/yii2-rbac репозитрриями
а именно
php yii migrate/up --migrationPath=@vendor/dektrium/yii2-user/migrations
php yii migrate/up --migrationPath=@yii/rbac/migrations

надо продолжить свои миграции две вот они

php yii migrate/up --migrationPath=@app/migrations/m170811_125456_add_new_field_to_profile.php
php yii migrate/up --migrationPath=@app/migrations/m170813_205400_projeckt

в принципе проект можно считать развернутым. За исключением маленькой операци надо
после регистрации первого админа
раскоментировать строку
//'admins' => ['Your name'] //first register user admin в
config/web.php модуля 'user' внести свое имя после выбрать пункт меню User redact.
Создать роли 'admin','manager','user' создаются они во вкладке create/New role и назначить роль admin администратору