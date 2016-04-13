## Установка
* Провести установку проекта YII2 (см README_YII2.md)
* Выполнить миграции  
```php
php yii migrate
```  
* Добавить роли
```php
php yii rbac/init
```

## Добавление новой модели с событием
* Содаем константу с именем события
```php
const EVENT_NEW_ARTICLE = 'new_article';
```
* В функции модели init присоединяем обработчик события, он един для всех.
Внутри обработчика уже происходит распознавание отправителя и создание сообщений для пользователей
```php
$this->on(self::EVENT_NEW_ARTICLE, ['app\components\HandlerEvents', 'newEvent']);
```
* Создаем функцию getTemplateVariables. Она генериует имена переменных с заполнением из модели
```php
public function getTemplateVariables()
{
    $variables = [];
    $className = strtolower((new \ReflectionClass($this))->getShortName());

    foreach ($this as $key => $val) {
        $variables['{'.$className.'_'.$key.'}'] = $val;
    }

    $variables['{'.$className.'_link}'] = Html::a('Читать далее', ['/article/view', 'id' => $this->id]);

    return $variables;
}
```
* Через админку добавить код события в бд

## Добавление нового обработчика событий
* Создать свой класс от BasicEvent
* В функцию newEvent класса HandlerEvents добавить новое условие с вызовом обработчика
* Через админку добавить тип события в бд