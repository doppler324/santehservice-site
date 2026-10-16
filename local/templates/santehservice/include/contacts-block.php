<!-- ===== Блок «Контакты» (#contacts). Вставляется перед футером на всех страницах ===== -->

<section id="contacts">
<div class="w">
 <div class="ct">
  <div class="cb">
   <h3>Контакты</h3>
   <div class="ci">
    <div><svg viewBox="0 0 24 24"><path d="M5 3h4l2 5-2.5 1.5a11 11 0 006 6L16 13l5 2v4a2 2 0 01-2 2A16 16 0 013 5a2 2 0 012-2z"/></svg><a class="pn" href="tel:+74957773679">+7 (495) 777-36-79</a></div>
    <div><svg viewBox="0 0 24 24"><path d="M12 21s7-6 7-11.5a7 7 0 10-14 0C5 15 12 21 12 21z"/><circle cx="12" cy="9.5" r="2.5"/></svg><span>г. Москва, ул. Лесная, д. 7, офис 305</span></div>
    <div><svg viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/></svg><a class="ml" href="mailto:info@uslugi-santechnika.ru">info@uslugi-santechnika.ru</a></div>
    <div><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3.5 2"/></svg><span>Ежедневно с 8:00 до 23:00</span></div>
   </div>
  </div>
  <div class="mp">
   <!-- Яндекс.Карты: замените ll и pt на координаты вашего офиса (долгота,широта) -->
   <iframe src="https://yandex.ru/map-widget/v1/?ll=37.5936%2C55.7797&z=16&pt=37.5936%2C55.7797%2Cpm2blm&lang=ru_RU" title="Мы на карте: г. Москва, ул. Лесная, д. 7" loading="lazy" allowfullscreen referrerpolicy="no-referrer-when-downgrade"></iframe>
  </div>
  <div class="cb fm2">
   <h3>Написать нам</h3>
   <?php require_once($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/home_webform_events.php"); ?> <?php global $APPLICATION; $APPLICATION->IncludeComponent("bitrix:form.result.new", "home_form", array(
       "WEB_FORM_ID"         => homeWebFormId(),
       "SEF_MODE"            => "N",
       "SUCCESS_URL"         => "",
       "USE_EXTENDED_ERRORS" => "N",
       "IGNORE_CUSTOM_TEMPLATE" => "N",
       "CACHE_TYPE"          => "N",
       "CHAIN_ITEM_TEXT"     => "",
       "CHAIN_ITEM_LINK"     => "",
       "FORM_VARIANT"        => "contacts",
       "FORM_SOURCE"         => "Блок «Контакты»",
       "BUTTON_TEXT"         => "Отправить",
       "MESSAGE_PLACEHOLDER" => "Ваш вопрос *",
       "MESSAGE_REQUIRED"    => "Y",
       "OK_TEXT"             => "Спасибо! Ответим в ближайшее время.",
   )); ?>
  </div>
 </div>
</div>
</section>

<!-- ===== конец блока «Контакты» ===== -->
