<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Вызов сантехника за 30 минут");   // это H1 страницы
$APPLICATION->SetPageProperty("title", "Вызов сантехника за 30 минут — СантехСервис");
$APPLICATION->SetPageProperty("description", "Срочный вызов сантехника в Москве круглосуточно: мастер приедет за 30 минут. Выезд бесплатно, фиксированная цена до начала работ, гарантия до 3 лет.");
$APPLICATION->SetPageProperty("og_title", "Вызов сантехника за 30 минут");
$APPLICATION->SetPageProperty("og_description", "Мастер приедет за 30 минут. Выезд и диагностика бесплатно, цена фиксируется до начала работ, гарантия до 3 лет.");

// Стили и скрипты главной (файлы лежат в /local/templates/santehservice/css|js)
$APPLICATION->AddHeadString('<link rel="preconnect" href="https://fonts.googleapis.com"><link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">');
$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/home.css");
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/home.js");
?>

<?php include_once($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/include/svg-sprite.php"); ?>

<div class="hm">
<!-- HERO -->
<section class="hero" id="order">
<div class="w">
 <div class="hl">
  <img class="pic" src="<?=SITE_TEMPLATE_PATH?>/images/home/hero.jpg" alt="Сантехник за работой">
  <span class="tag">САНТЕХНИЧЕСКИЕ УСЛУГИ В МОСКВЕ</span>
  <h1>Вызов сантехника в Москве за <em>30 минут</em></h1>
  <p class="sub">Фиксированная цена до начала работ. Выезд бесплатно. Работаем круглосуточно.</p>
  <div class="fe">
   <div><span class="cir"><svg class="i"><use href="#hm-bolt"/></svg></span>Выезд<br>за 30 минут</div>
   <div><span class="cir"><svg class="i"><use href="#hm-shield"/></svg></span>Гарантия<br>до 3 лет</div>
   <div><span class="cir"><svg class="i"><use href="#hm-coin"/></svg></span>Фиксированная<br>цена</div>
   <div><span class="cir"><svg class="i"><use href="#hm-doc"/></svg></span>Работаем<br>по договору</div>
  </div>
 </div>
 <?php $APPLICATION->IncludeComponent("bitrix:form.result.new", "home_form", array(
    "WEB_FORM_ID"         => homeWebFormId(),
    "SEF_MODE"            => "N",
    "SUCCESS_URL"         => "",
    "USE_EXTENDED_ERRORS" => "N",
    "IGNORE_CUSTOM_TEMPLATE" => "N",
    "CACHE_TYPE"          => "N",
    "CHAIN_ITEM_TEXT"     => "",
    "CHAIN_ITEM_LINK"     => "",
    "FORM_VARIANT"        => "hero",
    "FORM_SOURCE"         => "Баннер главной",
    "FORM_TITLE"          => "Оставьте заявку",
    "FORM_SUBTITLE"       => "и мастер приедет уже через 30 минут",
    "BUTTON_TEXT"         => "Вызвать мастера",
    "MESSAGE_PLACEHOLDER" => "Что нужно сделать? (необязательно)",
    "MESSAGE_REQUIRED"    => "N",
    "OK_TEXT"             => "Спасибо! Заявка принята — перезвоним в течение 5 минут.",
)); ?>
</div>
</section>

<!-- WHY -->
<section id="why">
<div class="w">
 <h2 class="t">Почему нам доверяют</h2>
 <div class="why">
  <div><span class="cir"><svg class="i"><use href="#hm-user"/></svg></span><p><b>Опыт более 10 лет</b><span>Мастера с профильным образованием.</span></p></div>
  <div><span class="cir"><svg class="i"><use href="#hm-truck"/></svg></span><p><b>Бесплатный выезд<br>и диагностика</b><span>Оценка работ на месте.</span></p></div>
  <div><span class="cir"><svg class="i"><use href="#hm-shield"/></svg></span><p><b>Гарантия на все работы</b><span>До 3 лет по договору.</span></p></div>
  <div><span class="cir"><svg class="i"><use href="#hm-coin"/></svg></span><p><b>Честные цены</b><span>Без скрытых платежей, смета до начала работ.</span></p></div>
  <div><span class="cir"><svg class="i"><use href="#hm-clock"/></svg></span><p><b>Срочный вызов 24/7</b><span>Работаем без выходных.</span></p></div>
  <div><span class="cir"><svg class="i"><use href="#hm-pen"/></svg></span><p><b>Собственный инструмент</b><span>Профессиональное оборудование.</span></p></div>
 </div>
</div>
</section>

<!-- SERVICES -->
<section id="services" style="padding-top:20px">
<div class="w" id="prices">
 <h2 class="t">Услуги сантехника</h2>
 <div class="tabs" role="tablist">
  <button class="a" type="button" data-t="0">Аварийные работы</button>
  <button type="button" data-t="1">Установка</button>
  <button type="button" data-t="2">Ремонт</button>
  <button type="button" data-t="3">Прочистка</button>
 </div>

 <div class="sv a" data-p="0">
  <div class="sc"><div class="im" style="background-image:url(<?=SITE_TEMPLATE_PATH?>/images/home/svc-1-1.jpg)"><span class="cir"><svg class="i"><use href="#hm-pipe"/></svg></span></div><div class="bd"><b>Устранение засоров</b><span class="pr">от 500 ₽</span><a class="btn" href="#order">Заказать</a></div></div>
  <div class="sc"><div class="im" style="background-image:url(<?=SITE_TEMPLATE_PATH?>/images/home/svc-1-2.jpg)"><span class="cir"><svg class="i"><use href="#hm-pipe"/></svg></span></div><div class="bd"><b>Устранение протечек</b><span class="pr">от 700 ₽</span><a class="btn" href="#order">Заказать</a></div></div>
  <div class="sc"><div class="im" style="background-image:url(<?=SITE_TEMPLATE_PATH?>/images/home/svc-1-3.jpg)"><span class="cir"><svg class="i"><use href="#hm-pipe"/></svg></span></div><div class="bd"><b>Аварийная замена сифона</b><span class="pr">от 900 ₽</span><a class="btn" href="#order">Заказать</a></div></div>
  <div class="sc"><div class="im" style="background-image:url(<?=SITE_TEMPLATE_PATH?>/images/home/svc-1-4.jpg)"><span class="cir"><svg class="i"><use href="#hm-pen"/></svg></span></div><div class="bd"><b>Перекрытие и слив воды</b><span class="pr">от 600 ₽</span><a class="btn" href="#order">Заказать</a></div></div>
 </div>
 <div class="sv" data-p="1">
  <div class="sc"><div class="im" style="background-image:url(<?=SITE_TEMPLATE_PATH?>/images/home/svc-2-1.jpg)"><span class="cir"><svg class="i"><use href="#hm-pipe"/></svg></span></div><div class="bd"><b>Замена смесителя</b><span class="pr">от 800 ₽</span><a class="btn" href="#order">Заказать</a></div></div>
  <div class="sc"><div class="im" style="background-image:url(<?=SITE_TEMPLATE_PATH?>/images/home/svc-2-2.jpg)"><span class="cir"><svg class="i"><use href="#hm-pipe"/></svg></span></div><div class="bd"><b>Установка унитаза</b><span class="pr">от 1500 ₽</span><a class="btn" href="#order">Заказать</a></div></div>
  <div class="sc"><div class="im" style="background-image:url(<?=SITE_TEMPLATE_PATH?>/images/home/svc-2-3.jpg)"><span class="cir"><svg class="i"><use href="#hm-pipe"/></svg></span></div><div class="bd"><b>Установка раковины</b><span class="pr">от 1200 ₽</span><a class="btn" href="#order">Заказать</a></div></div>
  <div class="sc"><div class="im" style="background-image:url(<?=SITE_TEMPLATE_PATH?>/images/home/svc-2-4.jpg)"><span class="cir"><svg class="i"><use href="#hm-pen"/></svg></span></div><div class="bd"><b>Подключение стиральной машины</b><span class="pr">от 1000 ₽</span><a class="btn" href="#order">Заказать</a></div></div>
 </div>
 <div class="sv" data-p="2">
  <div class="sc"><div class="im" style="background-image:url(<?=SITE_TEMPLATE_PATH?>/images/home/svc-3-1.jpg)"><span class="cir"><svg class="i"><use href="#hm-pipe"/></svg></span></div><div class="bd"><b>Ремонт бачка унитаза</b><span class="pr">от 700 ₽</span><a class="btn" href="#order">Заказать</a></div></div>
  <div class="sc"><div class="im" style="background-image:url(<?=SITE_TEMPLATE_PATH?>/images/home/svc-3-2.jpg)"><span class="cir"><svg class="i"><use href="#hm-pipe"/></svg></span></div><div class="bd"><b>Ремонт смесителя</b><span class="pr">от 600 ₽</span><a class="btn" href="#order">Заказать</a></div></div>
  <div class="sc"><div class="im" style="background-image:url(<?=SITE_TEMPLATE_PATH?>/images/home/svc-3-3.jpg)"><span class="cir"><svg class="i"><use href="#hm-pipe"/></svg></span></div><div class="bd"><b>Замена гибкой подводки</b><span class="pr">от 500 ₽</span><a class="btn" href="#order">Заказать</a></div></div>
  <div class="sc"><div class="im" style="background-image:url(<?=SITE_TEMPLATE_PATH?>/images/home/svc-3-4.jpg)"><span class="cir"><svg class="i"><use href="#hm-pen"/></svg></span></div><div class="bd"><b>Замена труб и фитингов</b><span class="pr">от 1800 ₽</span><a class="btn" href="#order">Заказать</a></div></div>
 </div>
 <div class="sv" data-p="3">
  <div class="sc"><div class="im" style="background-image:url(<?=SITE_TEMPLATE_PATH?>/images/home/svc-4-1.jpg)"><span class="cir"><svg class="i"><use href="#hm-pen"/></svg></span></div><div class="bd"><b>Прочистка канализации</b><span class="pr">от 1200 ₽</span><a class="btn" href="#order">Заказать</a></div></div>
  <div class="sc"><div class="im" style="background-image:url(<?=SITE_TEMPLATE_PATH?>/images/home/svc-4-2.jpg)"><span class="cir"><svg class="i"><use href="#hm-pipe"/></svg></span></div><div class="bd"><b>Прочистка раковины</b><span class="pr">от 500 ₽</span><a class="btn" href="#order">Заказать</a></div></div>
  <div class="sc"><div class="im" style="background-image:url(<?=SITE_TEMPLATE_PATH?>/images/home/svc-4-3.jpg)"><span class="cir"><svg class="i"><use href="#hm-pipe"/></svg></span></div><div class="bd"><b>Прочистка унитаза</b><span class="pr">от 800 ₽</span><a class="btn" href="#order">Заказать</a></div></div>
  <div class="sc"><div class="im" style="background-image:url(<?=SITE_TEMPLATE_PATH?>/images/home/svc-4-4.jpg)"><span class="cir"><svg class="i"><use href="#hm-pipe"/></svg></span></div><div class="bd"><b>Гидродинамическая прочистка</b><span class="pr">от 2500 ₽</span><a class="btn" href="#order">Заказать</a></div></div>
 </div>

 <div class="more"><a class="o" href="/uslugi/" style="font-size:13px;padding:12px 38px">Полный прайс-лист</a></div>
</div>
</section>

<!-- STEPS -->
<section class="band">
<div class="w">
 <h2 class="t">Как мы работаем</h2>
 <div class="st">
  <div><span class="cir"><svg class="i"><use href="#hm-doc"/></svg><i>1</i></span><b>Заявка</b><span>Оставляйте заявку или звоните.</span></div>
  <div><span class="cir"><svg class="i"><use href="#hm-chat"/></svg><i>2</i></span><b>Консультация</b><span>Уточняем детали, называем цену.</span></div>
  <div><span class="cir"><svg class="i"><use href="#hm-car"/></svg><i>3</i></span><b>Выезд мастера</b><span>Приезжаем в удобное время с инструментом.</span></div>
  <div><span class="cir"><svg class="i"><use href="#hm-pen"/></svg><i>4</i></span><b>Выполнение работ</b><span>Фиксированная цена, качественный ремонт.</span></div>
  <div><span class="cir"><svg class="i"><use href="#hm-shield"/></svg><i>5</i></span><b>Оплата и гарантия</b><span>Оплата после приемки работ, гарантийный талон.</span></div>
 </div>
</div>
</section>

<!-- STAFF -->
<section>
<div class="w">
 <h2 class="t">Наши специалисты</h2>
 <div class="stf">
  <div class="sp"><img src="<?=SITE_TEMPLATE_PATH?>/images/home/staff-1.jpg" alt="Алексей Иванов"><b>Алексей Иванов</b><span>Опыт работы: 12 лет<br>Ремонт труб</span><div class="st5">★★★★★</div></div>
  <div class="sp"><img src="<?=SITE_TEMPLATE_PATH?>/images/home/staff-2.jpg" alt="Дмитрий Кузнецов"><b>Дмитрий Кузнецов</b><span>Опыт работы: 10 лет<br>Установка сантехники</span><div class="st5">★★★★★</div></div>
  <div class="sp"><img src="<?=SITE_TEMPLATE_PATH?>/images/home/staff-3.jpg" alt="Сергей Петров"><b>Сергей Петров</b><span>Опыт работы: 8 лет<br>Прочистка канализации</span><div class="st5">★★★★★</div></div>
  <div class="sp"><img src="<?=SITE_TEMPLATE_PATH?>/images/home/staff-4.jpg" alt="Максим Федоров"><b>Максим Федоров</b><span>Опыт работы: 6 лет<br>Ремонт смесителей</span><div class="st5">★★★★★</div></div>
 </div>
</div>
</section>

<!-- REVIEWS -->
<section class="band" id="reviews">
<div class="w">
 <h2 class="t" style="text-align:left">Отзывы наших клиентов</h2>
 <div class="rv">
  <button class="ar" type="button" id="rp" aria-label="Назад"><svg class="i"><use href="#hm-prev"/></svg></button>
  <div class="rvw"><div class="rvt" id="rt">
   <div class="ri"><img src="<?=SITE_TEMPLATE_PATH?>/images/home/review-1.jpg" alt=""><div><div class="stars">★★★★★</div><div class="nm">Анна, м. Таганская</div><p>Отличная работа! Мастер приехал через 40 минут, быстро устранил засор. Вежливый, аккуратный, цена как договаривались. Рекомендую!</p><small>12.04.2026</small></div></div>
   <div class="ri"><img src="<?=SITE_TEMPLATE_PATH?>/images/home/review-2.jpg" alt=""><div><div class="stars">★★★★★</div><div class="nm">Игорь, м. Динамо</div><p>Меняли смеситель на кухне. Всё сделали за час, убрали за собой, выдали гарантийный талон. Цена совпала со сметой.</p><small>03.04.2026</small></div></div>
   <div class="ri"><img src="<?=SITE_TEMPLATE_PATH?>/images/home/review-3.jpg" alt=""><div><div class="stars">★★★★★</div><div class="nm">Марина, м. Бабушкинская</div><p>Ночью прорвало трубу под раковиной, позвонила — мастер был через 30 минут. Спасибо, выручили!</p><small>27.03.2026</small></div></div>
   <div class="ri"><img src="<?=SITE_TEMPLATE_PATH?>/images/home/review-4.jpg" alt=""><div><div class="stars">★★★★★</div><div class="nm">Олег, м. Люблино</div><p>Установили унитаз и подключили стиральную машину. Работают аккуратно, ничего не течёт уже месяц.</p><small>15.03.2026</small></div></div>
  </div></div>
  <button class="ar" type="button" id="rn" aria-label="Вперёд"><svg class="i"><use href="#hm-next"/></svg></button>
  <a class="o" href="#contacts" style="flex:none">Оставить отзыв</a>
 </div>
 <div class="dots" id="rd" style="position:static;justify-content:center;margin-top:14px"><i class="a"></i><i></i><i></i><i></i></div>
</div>
</section>

<!-- GUARANTEE -->
<section id="guarantee" style="padding-bottom:20px">
<div class="w">
 <h2 class="l">Гарантии и прозрачность</h2>
 <div class="gt">
  <div><span class="cir"><svg class="i"><use href="#hm-doc"/></svg></span>Работаем по официальному договору</div>
  <div><span class="cir"><svg class="i"><use href="#hm-doc"/></svg></span>Предоставляем акт выполненных работ</div>
  <div><span class="cir"><svg class="i"><use href="#hm-coin"/></svg></span>Фиксированная смета без доплат</div>
  <div><span class="cir"><svg class="i"><use href="#hm-shield"/></svg></span>Гарантия до 3 лет на все виды работ</div>
  <div class="tl"><i></i><i>ГАРАНТИЙНЫЙ<br>ТАЛОН</i></div>
 </div>
</div>
</section>

<!-- FAQ -->
<section id="faq" style="padding-top:20px;padding-bottom:20px">
<div class="w">
 <h2 class="l">Частые вопросы</h2>
 <div class="fq">
  <div>
   <details><summary>Сколько стоит вызов сантехника?</summary><p>Выезд и диагностика бесплатны. Стоимость работ называем до начала по прайс-листу и фиксируем в смете — доплат по факту не бывает.</p></details>
   <details><summary>Как быстро приедет мастер?</summary><p>В пределах МКАД — от 30 минут, в ближнем Подмосковье — от 60 минут. Точное время назовёт диспетчер при звонке.</p></details>
   <details><summary>Даёте ли вы гарантию?</summary><p>Да, на все виды работ — до 3 лет. Гарантийный талон и акт выполненных работ выдаём после приёмки.</p></details>
   <details><summary>Работаете ли вы ночью?</summary><p>Да, принимаем заявки и выезжаем круглосуточно, без выходных. Ночной тариф не применяется.</p></details>
  </div>
  <div class="qb"><span class="cir"><svg class="i"><use href="#hm-chat"/></svg></span><div><b>Остались вопросы?</b><p>Напишите нам в Telegram, и мы ответим в течение 5 минут!</p><div class="bt"><a href="#" style="background:#2196e8">Telegram</a></div></div></div>
 </div>
</div>
</section>

<?php include($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/include/contacts-block.php"); ?>
</div>

<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>
