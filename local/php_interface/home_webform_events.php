<?php
/**
 * Веб-форма «Заявки с сайта» (модуль «Веб-формы»): вспомогательные функции и защита от спама.
 * Подключить ОДИН раз в /local/php_interface/init.php:
 *     require_once($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/home_webform_events.php");
 */

/** ID веб-формы по её символьному идентификатору (по умолчанию SIMPLE_FORM_1) */
function homeWebFormId($sid = "SIMPLE_FORM_1")
{
    static $cache = array();
    if (isset($cache[$sid])) {
        return $cache[$sid];
    }
    $id = 0;
    if (\Bitrix\Main\Loader::includeModule("form")) {
        $row = CForm::GetBySID($sid)->Fetch();
        $id = $row ? (int)$row["ID"] : 0;
    }
    return $cache[$sid] = $id;
}

AddEventHandler("form", "onBeforeResultAdd", "homeWebFormBeforeResultAdd");

/** Спам-ловушка: скрытое поле «website» должно быть пустым. Ошибка отменяет сохранение результата и письмо. */
function homeWebFormBeforeResultAdd($WEB_FORM_ID, &$arFields, &$arrVALUES)
{
    global $strError;
    if ((int)$WEB_FORM_ID !== homeWebFormId()) {
        return;
    }
    if (!empty($_POST["website"])) {
        $strError .= "Заявка отклонена." . "<br>";
    }
}
