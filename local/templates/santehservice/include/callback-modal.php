<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?// Всплывающая форма «Заказать звонок»: имя + телефон (+ согласие). Сохраняется в ту же веб-форму, источник «Заказать звонок». ?>
<?php require_once($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/home_webform_events.php"); ?>
<div class="cbm" id="callback" role="dialog" aria-modal="true" aria-labelledby="cbm-t">
  <div class="cbm-card">
    <a href="#" class="cbm-x" aria-label="Закрыть">&times;</a>
    <h3 id="cbm-t">Заказать звонок</h3>
    <div class="cbm-s">Оставьте номер — перезвоним в течение 5 минут</div>
    <?php global $APPLICATION; $APPLICATION->IncludeComponent("bitrix:form.result.new", "home_form", array(
        "WEB_FORM_ID"            => homeWebFormId(),
        "SEF_MODE"               => "N",
        "SUCCESS_URL"            => "",
        "USE_EXTENDED_ERRORS"    => "N",
        "IGNORE_CUSTOM_TEMPLATE" => "N",
        "CACHE_TYPE"             => "N",
        "CHAIN_ITEM_TEXT"        => "",
        "CHAIN_ITEM_LINK"        => "",
        "FORM_VARIANT"           => "callback",
        "FORM_SOURCE"            => "Заказать звонок (шапка)",
        "BUTTON_TEXT"            => "Перезвоните мне",
        "OK_TEXT"                => "Спасибо! Перезвоним в течение 5 минут.",
    )); ?>
  </div>
</div>
