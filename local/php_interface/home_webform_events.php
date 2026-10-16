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

/** Российский номер -> «+7 (XXX) XXX-XX-XX» или false, если номер не российский/неполный */
function homeNormalizePhone($v)
{
    $d = preg_replace('/\D/', '', (string)$v);
    if (strlen($d) === 11 && ($d[0] === '7' || $d[0] === '8')) {
        $d = substr($d, 1);
    }
    if (strlen($d) !== 10 || strpos('3459', $d[0]) === false) {
        return false;
    }
    return sprintf('+7 (%s) %s-%s-%s', substr($d, 0, 3), substr($d, 3, 3), substr($d, 6, 2), substr($d, 8, 2));
}

/** Спам-ловушка: скрытое поле «website» должно быть пустым. Ошибка отменяет сохранение результата и письмо. */
function homeWebFormBeforeResultAdd($WEB_FORM_ID, &$arFields, &$arrVALUES)
{
    global $strError;
    if ((int)$WEB_FORM_ID !== homeWebFormId()) {
        return;
    }
    if (!empty($_POST["website"])) {
        $strError .= "Заявка отклонена." . "<br>";
        return;
    }
    // проверка и нормализация телефона на сервере (вопрос PHONE или с заголовком «Телефон…»)
    $arForm = $arQuestions = $arAnswers = $arDropDown = $arMultiSelect = array();
    CForm::GetDataByID($WEB_FORM_ID, $arForm, $arQuestions, $arAnswers, $arDropDown, $arMultiSelect);
    foreach ($arQuestions as $sid => $q) {
        $title = mb_strtolower(trim(strip_tags($q["TITLE"] ?? "")));
        if ($sid !== "PHONE" && strpos($title, "телефон") !== 0 && strpos($title, "phone") !== 0) {
            continue;
        }
        foreach ((array)($arAnswers[$sid] ?? array()) as $a) {
            $key = "form_" . $a["FIELD_TYPE"] . "_" . $a["ID"];
            if (!isset($_REQUEST[$key])) {
                continue;
            }
            $norm = homeNormalizePhone($_REQUEST[$key]);
            if ($norm === false) {
                $strError .= "Укажите российский номер телефона полностью: +7 (9XX) XXX-XX-XX<br>";
            } else {
                $_REQUEST[$key] = $_POST[$key] = $norm;
                if (isset($arrVALUES[$key])) {
                    $arrVALUES[$key] = $norm;
                }
            }
        }
        break;
    }
}
}
