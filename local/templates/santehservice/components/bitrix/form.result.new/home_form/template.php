<?php if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
/**
 * Шаблон home_form для bitrix:form.result.new (модуль «Веб-формы»).
 * Поля веб-формы ищутся по символьным идентификаторам вопросов: NAME, PHONE, MESSAGE, SOURCE, PAGE, AGREE.
 * Параметры вызова: FORM_VARIANT = "hero" | "contacts", FORM_TITLE, FORM_SUBTITLE, BUTTON_TEXT,
 * MESSAGE_PLACEHOLDER, MESSAGE_REQUIRED (Y/N — только проверка в браузере), FORM_SOURCE, OK_TEXT.
 */
$hero   = ($arParams["FORM_VARIANT"] ?? "") === "hero";
$cb     = ($arParams["FORM_VARIANT"] ?? "") === "callback"; // всплывающая форма: только имя и телефон
$Q      = $arResult["QUESTIONS"] ?? array();
$formId = (int)($arResult["arForm"]["ID"] ?? 0);
$fid    = "hmf-".$formId."-".($hero ? "hero" : ($cb ? "callback" : "contacts"));
$isOk   = ($arResult["isFormNote"] ?? "") === "Y";
$msgReq = ($arParams["MESSAGE_REQUIRED"] ?? "N") === "Y";

// вопрос ищется по SID (NAME, PHONE...), а если SID иной (упрощённый режим) — по заголовку вопроса
$aliases = array(
    "NAME" => array("имя", "ваше имя", "name"), "PHONE" => array("телефон", "phone"),
    "MESSAGE" => array("сообщение", "комментарий", "вопрос", "message"), "SOURCE" => array("источник", "source"),
    "PAGE" => array("страница", "page"), "AGREE" => array("согласие", "agree"),
);
$map = array();
foreach ($aliases as $logical => $names) {
    if (isset($Q[$logical])) { $map[$logical] = $logical; continue; }
    foreach ($Q as $key => $q) {
        $cap = mb_strtolower(trim(strip_tags($q["CAPTION"] ?? "")));
        foreach ($names as $n) { if ($cap === $n || strpos($cap, $n) === 0) { $map[$logical] = $key; break 2; } }
    }
}
$ans = function ($sid) use ($Q, $map) {
    $k = $map[$sid] ?? null;
    if ($k === null || empty($Q[$k]["STRUCTURE"][0])) return null;
    $a = $Q[$k]["STRUCTURE"][0];
    return array("id" => (int)$a["ID"], "type" => $a["FIELD_TYPE"]);
};
$nm  = function ($sid, $multi = false) use ($ans, $map) {
    $a = $ans($sid);
    if (!$a) return null;
    if ($a["type"] === "checkbox") return "form_checkbox_".$map[$sid]."[]";
    return "form_".$a["type"]."_".$a["id"];
};
$val = function ($sid) use ($ans) {
    $a = $ans($sid);
    return $a ? htmlspecialcharsbx($_REQUEST["form_".$a["type"]."_".$a["id"]] ?? "") : "";
};

$errors = array();
if (($arResult["isFormErrors"] ?? "") === "Y" && !empty($arResult["FORM_ERRORS"])) {
    foreach ((array)$arResult["FORM_ERRORS"] as $e) { $errors[] = trim(strip_tags($e)); }
}
$source = ($arParams["FORM_SOURCE"] ?? ($hero ? "Баннер главной" : "Блок «Контакты»")) . "; IP " . ($_SERVER["REMOTE_ADDR"] ?? "");
$page   = (isset($_SERVER["HTTP_HOST"]) ? "https://".$_SERVER["HTTP_HOST"] : "") . ($_SERVER["REQUEST_URI"] ?? "");
$missing = array();
foreach (array("NAME","PHONE","MESSAGE","AGREE") as $sid) { if (!$ans($sid)) $missing[] = $sid; }
?>
<?php if ($formId <= 0 || $missing): ?>
  <div class="<?=$hero ? "fm" : ""?>" style="padding:16px;color:#d12c2c;font-size:13px">
    Веб-форма не настроена<?=$missing ? " (нет вопросов: ".htmlspecialcharsbx(implode(", ", $missing)).")" : ""?>. См. README, раздел «Веб-форма».
  </div>
<?php return; endif; ?>
<form action="<?=POST_FORM_ACTION_URI?>" method="POST" id="<?=$fid?>" class="<?=$hero ? "fm" : ""?>" data-hmf="<?=$formId?>" novalidate="novalidate">
  <?=bitrix_sessid_post()?>
  <input type="hidden" name="WEB_FORM_ID" value="<?=$formId?>">
  <input type="hidden" name="web_form_submit" value="Y">
  <?php if ($ans("SOURCE")): ?><input type="hidden" name="<?=$nm("SOURCE")?>" value="<?=htmlspecialcharsbx($source)?>"><?php endif; ?>
  <?php if ($ans("PAGE")): ?><input type="hidden" name="<?=$nm("PAGE")?>" value="<?=htmlspecialcharsbx($page)?>"><?php endif; ?>
  <div style="position:absolute;left:-9999px;top:-9999px" aria-hidden="true"><input type="text" name="website" tabindex="-1" autocomplete="off"></div>
  <div class="fields"<?=$isOk ? ' style="display:none"' : ""?>>
    <?php if ($hero): ?>
      <h3><?=htmlspecialcharsbx($arParams["FORM_TITLE"] ?? "Оставьте заявку")?></h3>
      <div class="s"><?=htmlspecialcharsbx($arParams["FORM_SUBTITLE"] ?? "")?></div>
    <?php endif; ?>
    <div class="er"<?=$errors ? ' style="display:block"' : ""?>><?php foreach ($errors as $e): ?><div><?=htmlspecialcharsbx($e)?></div><?php endforeach; ?></div>
    <input type="text" name="<?=$nm("NAME")?>" placeholder="Ваше имя *" value="<?=$val("NAME")?>" data-f="name" required>
    <input type="tel" name="<?=$nm("PHONE")?>" placeholder="+7 (___) ___-__-__ *" value="<?=$val("PHONE")?>" data-f="phone" required>
    <?php if (!$cb): ?>
    <?php $mt = $ans("MESSAGE")["type"]; ?>
    <?php if ($hero && $mt !== "textarea"): ?>
      <input type="text" name="<?=$nm("MESSAGE")?>" placeholder="<?=htmlspecialcharsbx($arParams["MESSAGE_PLACEHOLDER"] ?? "Что нужно сделать? (необязательно)")?>" value="<?=$val("MESSAGE")?>" data-f="msg">
    <?php else: ?>
      <textarea name="<?=$nm("MESSAGE")?>" placeholder="<?=htmlspecialcharsbx($arParams["MESSAGE_PLACEHOLDER"] ?? "Ваш вопрос *")?>" data-f="msg"<?=$msgReq ? " required" : ""?>><?=$val("MESSAGE")?></textarea>
    <?php endif; ?>
    <?php endif; ?>
    <label class="ag"><input type="checkbox" name="<?=$nm("AGREE")?>" value="<?=(int)$ans("AGREE")["id"]?>" data-f="agree" required><span>Я даю <a href="/consent/" target="_blank">согласие на обработку персональных данных</a> и принимаю <a href="/privacy/" target="_blank">Политику конфиденциальности</a></span></label>
    <button class="<?=$hero ? "btn" : "sbt"?>" type="submit"><?=htmlspecialcharsbx($arParams["BUTTON_TEXT"] ?? ($hero ? "Вызвать мастера" : "Отправить"))?></button>
  </div>
  <div class="ok"<?=$isOk ? ' style="display:block"' : ""?>><?=htmlspecialcharsbx($arParams["OK_TEXT"] ?? "Спасибо! Заявка принята.")?></div>
</form>
