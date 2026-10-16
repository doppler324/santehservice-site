<?php
/**
 * Обработчик писем формы main.feedback (шаблон home_form).
 * Подключить ОДИН раз в /local/php_interface/init.php:
 *     require_once($_SERVER["DOCUMENT_ROOT"]."/local/php_interface/home_feedback_events.php");
 *
 * Что делает:
 *  - дописывает в текст письма телефон, источник формы, факт согласия на обработку ПДн (дата, IP, страница, версия политики);
 *  - молча отбрасывает заявки, где заполнено скрытое поле-ловушка "website" (спам-боты) или не отмечено согласие.
 */
AddEventHandler("main", "OnBeforeEventAdd", "homeFeedbackBeforeEventAdd");

function homeFeedbackBeforeEventAdd(&$event, &$lid, &$arFields, &$messageId, &$files, &$languageId)
{
    if ($event !== "FEEDBACK_FORM" || !isset($_POST["hm_form"])) {
        return; // чужая форма — не трогаем
    }
    // спам-ловушка и согласие
    if (!empty($_POST["website"]) || ($_POST["agree"] ?? "") !== "Y") {
        return false; // письмо не отправляется (пользователь увидит «успех», бот ничего не поймёт)
    }
    $phone = preg_replace('/[^\d+()\-\s]/', '', (string)($_POST["phone"] ?? ""));
    if (strlen(preg_replace('/\D/', '', $phone)) < 10) {
        return false;
    }
    $source = strip_tags((string)$_POST["hm_form"]);
    $page   = (isset($_SERVER["HTTP_REFERER"]) && $_SERVER["HTTP_REFERER"] !== "") ? $_SERVER["HTTP_REFERER"] : $_SERVER["REQUEST_URI"];
    $text   = "Телефон: " . $phone . "\n"
            . "Источник: " . $source . "\n"
            . "Страница: " . strip_tags($page) . "\n"
            . "Согласие на обработку персональных данных: ДА (" . date("d.m.Y H:i:s") . ", IP " . $_SERVER["REMOTE_ADDR"] . ", политика v. 2026-10)\n"
            . "------------------------------\n"
            . trim((string)($arFields["TEXT"] ?? ""));
    $arFields["TEXT"] = $text;
}
