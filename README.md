разворачиваем проект следующим образом
**composer create-project sergalas/yii2-test-basic:"dev-master"**

завершаем миграции кроме основых установленных  этим *dektrium/yii2-user* и этим  *dektrium/yii2-rbac* репозитрриями
а именно:

*php yii migrate/up --migrationPath=@vendor/dektrium/yii2-user/migrations*

*php yii migrate/up --migrationPath=@yii/rbac/migrations*

надо продолжить свои миграции две вот они

*php yii migrate/up --migrationPath=@app/migrations/*

в принципе проект можно считать развернутым. За исключением маленькой операци надо
после регистрации первого админа
раскоментировать строку
```//'admins' => ['Your name'] //first register user ```
admin в config/web.php модуля 'user' внести свое имя после выбрать пункт меню User redact.
Создать роли 'admin','manager','user' создаются они во вкладке create/New role и назначить роль admin администратору