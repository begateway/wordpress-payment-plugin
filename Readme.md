## WordPress beGateway Payment plugin

[Русская версия](#wordpress-begateway-payment-плагин)

### Installation

  * Backup your WordPress and database
  * Download [begateway-payment.zip](https://github.com/beGateway/wordpress-payment-plugin/blob/master/begateway-payment.zip?raw=true)
  * Start up the administrative panel for WordPress (www.yourshop.com/wp-admin/)
  * Choose _Plugins -> Add New_
  * Upload the payment module archive via **Upload Plugin**.
  * Choose _Plugins -> Installed Plugins_ and find the _beGateway Payment_ plugin and activate it.

### Setup

Now go to _Settings -> beGateway Payment_ to configure the plugin settings.

### Plugin usage

There are a few ways you can use this plugin:

  * Configure the options below and then add the shortcode `[begateway_payment]` to a post or page
  * Call the function from a template file: `<?php echo do_shortcode('[begateway_payment]'); ?>`
  * Use the beGateway Payment widget from the Widgets menu

#### Shortcode Parameters

Optionally, you can add some more parameters in the above mentioned shortcode to customize the currency code, reference title, return page URL, tax etc. Below is a list of the supported parameters in the payment button shortcode

  * class - Form CSS class
  * button_text - Title of proceed to payment button
  * button_class - Payment button CSS class
  * payment_subject - Product or service name or the reason for the payment here. The visitors will see this text
  * other_amount - Set to 1 if you want to show other amount text box to your visitors so they can enter custom amount.
  * other_amount_title - Title for the other amount text box. The visitors will see this text.
  * text_box - Set to 1 if you want your visitors to be able to enter a reference text like email, web address or name.
  * text_box_title - Title for the Reference text box (ie. your web address). The visitors will see this text.
  * options - Payment options to show visitors. Usage sample: Product 1:10.00|Product 2:15.00
  * type - Set to 1 if you want to show other amount text box to your visitors so they can enter custom amount.
  * shop_id - This is your shop id found in your backoffice
  * shop_key - This is your shop secret key found in your backoffice
  * checkout_base - This is payment page domain of your payment service provide
  * card - Set to 1 if you want to accept bankcard payments.
  * erip - Set to 1 if you want to accept erip payments.
  * erip_service_no - Your ERIP service code.
  * personal_details - Set to 1 if you want your visitors to be required to enter personal details (name, address and etc) during payment process.
  * notification_url - Notification URL where beGateway will post messages about processed payments.
  * success_url - Success URL where your customer will be redirected after a successful payment
  * decline_url - Decline URL where your customer will be redirected after a payment error
  * fail_url - Fail URL where your customer will be redirected after a failed payment
  * cancel_url - Cancel URL where your customer will be redirected when a payment process is cancelled by the customer
  * language - Payment page language. Use two letter code e.g. en for English
  * currency - Currency code (USD, EUR and etc) for your visitors to make payments

##### Shortcode usage example

The shortcode will show a drop-down list with two products to pay: Product 1 with the 10.00 EUR price and Product 2 with the 20.00 EUR price.

    [begateway_payment options="Product 1:10.00|Product 2:20.00" currency="EUR"]

### Notes

Tested and developed with:

  * WordPress 4.2.x / 4.3.x

PHP 5.3+ is required.

### Demo credentials

You are free to use the settings to configure the plugin to process
payments with a demo gateway.

  * Shop Id __361__
  * Shop secret key __b8647b68898b084b836474ed8d61ffe117c9a01168d867f24953b776ddcb134d__
  * Payment page domain __checkout.begateway.com__

Use the test data to make a test payment:

  * card number __4200000000000000__
  * card name __JOHN DOE__
  * card expiry date __01/30__ to get a success payment
  * card expiry date __10/30__ to get a failed payment
  * CVC __123__

### Contributing

Issue pull requests or send feature requests.

## WordPress beGateway Payment плагин

[English version](#wordpress-begateway-payment-plugin)

### Установка

  * Создайте резервную копию вашего WordPress и базы данных
  * Загрузите [begateway-payment.zip](https://github.com/beGateway/wordpress-payment-plugin/blob/master/begateway-payment.zip?raw=true)
  * Зайдите в панель администратора WordPress (www.yourshop.com/wp-admin/)
  * Выберите _Плагины -> Добавить новый_
  * Загрузите модуль через **Добавить новый**
  * Выберите _Плагины -> Установленные_ и найдите _beGateway Payment_ плагин и активируйте его.

### Настройка

Перейдите в меню _Настройки -> beGateway Payment_, чтобы настроить плагин.

### Использование плагина

Есть несколько способов, как вы можете использовать этот плагин:

  * Настройте указанные ниже параметры, а затем добавьте shortcode `[begateway_payment]` на пост или страницу
  * Вызовите функцию из файла шаблона: `<?php echo do_shortcode('[begateway_payment]'); ?>`
  * Используйте beGateway Payment виджет из меню виджетов

#### Параметры шорткодов

При необходимости можно добавить некоторые дополнительные параметры в упомянутые выше шорткоды для настройки код валюты, заголовка оплаты и др. Ниже приводится список поддерживаемых параметров в шорткоде оплаты

  * class - CSS-класс формы
  * button_text - Текст кнопки оплаты
  * button_class - CSS-класс кнопки оплаты
  * payment_subject - Название продукта или услуги или причина для оплаты. Посетители увидят этот текст
  * other_amount - Передайте 1, если вы хотите, чтобы показывалось поле для ввода произвольной суммы платежа.
  * other_amount_title - Заголовок для поля ввода произвольной суммы. Посетители увидят этот текст.
  * text_box - Передайте 1, если вы хотите, чтобы ваши посетители имели возможность ввести текст описания за что оплата.
  * text_box_title - Заголовок для текстового поля описания оплаты. Посетители увидят этот текст.
  * options - Варианты оплаты, чтобы показать посетителям. Пример использования: Продукт 1:10.00|Продукт 2:15.00
  * type - Передайте 1, если вы хотите, чтобы показывалось поле для ввода произвольной суммы платежа.
  * shop_id - Это ваш идентификатор магазина, найденный в вашем личном кабинете поставщика платежных услуг
  * shop_key - Это секретный ключ вашего магазина, найденный в вашем личном кабинете поставщика платежных услуг
  * checkout_base - Это домен страницы оплаты поставщика платежных услуг
  * card - Передайте 1, если вы хотите принимать платежи банковскими картами.
  * erip - Передайте 1, если вы хотите принимать платежи ЕРИП.
  * erip_service_no - Код услуги ЕРИП.
  * personal_details - Передайте 1, если вы хотите, чтобы ваши посетители вводили личные данные (имя, адрес и т.д.) во время процесса оплаты.
  * notification_url - URL для уведомлений, куда beGateway будет отправлять сообщения об обработанных платежах
  * success_url - URL, куда ваш клиент будет перенаправлен после успешной оплаты
  * decline_url - URL, куда ваш клиент будет перенаправлен после ошибки оплаты
  * fail_url - URL, куда ваш клиент будет перенаправлен после неудачной оплаты
  * cancel_url - URL, куда ваш клиент будет перенаправлен, когда процесс оплаты был отменен вашим клиентом
  * language - Язык страницы оплаты. Используйте двухбуквенный код. Например, для английской en
  * currency - Код валюты (USD, EUR и т.д.) оплаты

##### Пример использования шорткода

Код, приведенный ниже, создаст на странице выпадающий список с двумя продуктами для оплаты: Product 1 с ценой 10.00 EUR и Product 2 с ценой 20.00 EUR.

    [begateway_payment options="Product 1:10.00|Product 2:20.00" currency="EUR"]

### Примечания

Разработанно и протестированно с:

  * WordPress 4.2.x / 4.3.x

Требуется PHP 5.3+

### Тестовые данные

Вы можете использовать следующие данные, чтобы настроить способ оплаты в
тестовом режиме:

  * Идентификационный номер магазина __361__
  * Секретный ключ магазина __b8647b68898b084b836474ed8d61ffe117c9a01168d867f24953b776ddcb134d__
  * Домен платежной страницы __checkout.begateway.com__

Используйте следующий тестовый набор для тестового платежа:

  * номер карты __4200000000000000__
  * имя на карте __JOHN DOE__
  * срок действия карты __01/30__, чтобы получить успешный платеж
  * срок действия карты __10/30__, чтобы получить неуспешный платеж
  * CVC __123__
