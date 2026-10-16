<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Цены на услуги сантехника в Москве");
$APPLICATION->SetPageProperty("title", "Цены на услуги сантехника в Москве — прайс-лист от 400 ₽ | СантехСервис");
$APPLICATION->SetPageProperty("description", "Прайс-лист СантехСервис: устранение засоров от 500 ₽, замена смесителя от 800 ₽, установка унитаза от 1500 ₽. Фиксированная цена по договору, выезд от 30 минут, гарантия до 3 лет.");
$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH . "/css/prices.css");

$sections = include($_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/include/prices-data.php");
$fmt = function ($n) { return number_format((int)$n, 0, "", "\u{00A0}"); };

// микроразметка: хлебные крошки + каталог услуг с ценами «от»
$catalog = array();
foreach ($sections as $s) {
    $offers = array();
    foreach ($s["items"] as $it) {
        $offers[] = array(
            "@type" => "Offer",
            "itemOffered" => array("@type" => "Service", "name" => $it[0]),
            "priceSpecification" => array("@type" => "PriceSpecification", "minPrice" => (int)$it[2], "priceCurrency" => "RUB"),
        );
    }
    $catalog[] = array("@type" => "OfferCatalog", "name" => $s["title"], "itemListElement" => $offers);
}
$ld = array(
    array("@context" => "https://schema.org", "@type" => "BreadcrumbList", "itemListElement" => array(
        array("@type" => "ListItem", "position" => 1, "name" => "Главная", "item" => "https://uslugi-santechnika.ru/"),
        array("@type" => "ListItem", "position" => 2, "name" => "Цены", "item" => "https://uslugi-santechnika.ru/ceny/"),
    )),
    array("@context" => "https://schema.org", "@type" => "Service", "name" => "Услуги сантехника в Москве",
        "provider" => array("@type" => "Organization", "name" => "СантехСервис", "url" => "https://uslugi-santechnika.ru/"),
        "areaServed" => "Москва и Московская область",
        "hasOfferCatalog" => array("@type" => "OfferCatalog", "name" => "Прайс-лист", "itemListElement" => $catalog)),
);
?>
<div class="pr">
<div class="w">
  <nav class="crumbs" aria-label="Хлебные крошки"><a href="/">Главная</a> / Цены</nav>
  <h1>Цены на услуги сантехника в Москве</h1>
  <p class="lead">Стоимость указана «от» — точная цена фиксируется после осмотра и записывается в договор до начала работ. Выезд мастера и диагностика бесплатны при заказе работ.</p>
  <div class="trust">
    <div><b>Выезд от 30 минут</b>по Москве и ближнему Подмосковью</div>
    <div><b>Фиксированная цена</b>не меняется по ходу работ</div>
    <div><b>Гарантия до 3 лет</b>на работы, по договору</div>
    <div><b>Оплата после приёмки</b>наличными или картой</div>
  </div>

  <div class="chips" id="prchips">
    <?php foreach ($sections as $s): ?><a href="#<?=$s["id"]?>"><?=htmlspecialcharsbx($s["title"])?></a><?php endforeach; ?>
  </div>

  <?php foreach ($sections as $s): ?>
    <h2 id="<?=$s["id"]?>"><?=htmlspecialcharsbx($s["title"])?></h2>
    <table>
      <thead><tr><th>Услуга</th><th class="u">Ед.</th><th>Цена</th><th></th></tr></thead>
      <tbody>
      <?php foreach ($s["items"] as $it): ?>
        <tr><td><?=htmlspecialcharsbx($it[0])?></td><td class="u"><?=htmlspecialcharsbx($it[1])?></td><td class="p">от <?=$fmt($it[2])?> ₽</td><td class="a"><a class="btn o" href="#contacts">Заказать</a></td></tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  <?php endforeach; ?>

  <div class="sec">
    <h2 style="margin-top:0">От чего зависит стоимость</h2>
    <div class="fac">
      <div><b>1</b>Сложность работ и доступ к коммуникациям</div>
      <div><b>2</b>Состояние труб, арматуры и сантехники</div>
      <div><b>3</b>Стоимость материалов и комплектующих</div>
      <div><b>4</b>Объём работ и срочность (ночью, в выходные)</div>
    </div>
    <div class="pros">
      <div><b>Входит в цену</b><br>выезд и диагностика (при заказе работ), работа мастера, уборка после работ, чек и гарантийный талон</div>
      <div><b>Оплачивается отдельно</b><br>материалы и комплектующие (по чеку или нашим ценам), вывоз крупногабаритного мусора, штробление и демонтаж стен</div>
    </div>
    <p class="note">Не нашли нужную услугу в прайсе? Позвоните — назовём точную цену за 5 минут. Публикуемые цены не являются публичной офертой.</p>
  </div>
</div>
</div>

<div class="pr-cta">
  <div><b>Не нашли нужную услугу?</b><span>Позвоните или оставьте заявку — назовём точную цену за 5 минут.</span></div>
  <a href="#contacts">Вызвать мастера</a>
</div>

<script type="application/ld+json"><?=json_encode($ld, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)?></script>
<script>
(function(){
  var h=document.querySelector('header'),c=document.getElementById('prchips'),r=document.documentElement;
  function set(){ if(h) r.style.setProperty('--hh',h.offsetHeight+'px'); if(c) r.style.setProperty('--ch',c.offsetHeight+'px'); }
  set(); addEventListener('resize',set); addEventListener('load',set);
  // подсветка раздела в строке рубрик при прокрутке
  var links=[].slice.call(document.querySelectorAll('#prchips a')), heads=links.map(function(a){return document.getElementById(a.getAttribute('href').slice(1))});
  function spy(){ var y=(h?h.offsetHeight:0)+(c?c.offsetHeight:0)+20, cur=-1; heads.forEach(function(e,i){ if(e && e.getBoundingClientRect().top<=y) cur=i; }); links.forEach(function(a,i){a.classList.toggle('on',i===cur)}); }
  addEventListener('scroll',spy,{passive:true}); spy();
})();
</script>
<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
