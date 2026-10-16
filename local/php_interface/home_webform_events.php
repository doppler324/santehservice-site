<?php
/**
 * Веб-форма «Заявки с сайта» (модуль «Веб-формы»): вспомогательные функции и защита от спама.
 * Подключается из index.php и contacts-block.php; повторное подключение (в том числе из другого пути) безопасно.
 */
if (!function_exists("homeWebFormId")) {

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
}
