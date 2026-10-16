<?php if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
/**
 * Шаблон home_form для bitrix:main.feedback.
 * Параметры вызова: FORM_VARIANT = "hero" (форма в баннере) | "contacts" (блок «Контакты»),
 * FORM_TITLE, FORM_SUBTITLE, BUTTON_TEXT, MESSAGE_PLACEHOLDER, MESSAGE_REQUIRED (Y/N), FORM_SOURCE.
 */
$hero   = ($arParams["FORM_VARIANT"] ?? "") === "hero";
$fid    = "hmf-".$arResult["PARAMS_HASH"];
$isOk   = !empty($arResult["OK_MESSAGE"]);
$errors = !empty($arResult["ERROR_MESSAGE"]) ? (array)$arResult["ERROR_MESSAGE"] : array();
$msgReq = ($arParams["MESSAGE_REQUIRED"] ?? "N") === "Y";
$phone  = htmlspecialcharsbx($_POST["phone"] ?? "");
?>
<form action="<?=POST_FORM_ACTION_URI?>" method="POST" id="<?=$fid?>" class="<?=$hero ? "fm" : ""?>" data-hmf="<?=$arResult["PARAMS_HASH"]?>" novalidate="novalidate">
  <?=bitrix_sessid_post()?>
  <input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
  <input type="hidden" name="submit" value="Y">
  <input type="hidden" name="hm_form" value="<?=htmlspecialcharsbx($arParams["FORM_SOURCE"] ?? ($hero ? "Баннер главной" : "Блок «Контакты»"))?>">
  <div style="position:absolute;left:-9999px;top:-9999px" aria-hidden="true"><input type="text" name="website" tabindex="-1" autocomplete="off"></div>
  <div class="fields"<?=$isOk ? ' style="display:none"' : ""?>>
    <?php if($hero): ?>
      <h3><?=htmlspecialcharsbx($arParams["FORM_TITLE"] ?? "Оставьте заявку")?></h3>
      <div class="s"><?=htmlspecialcharsbx($arParams["FORM_SUBTITLE"] ?? "")?></div>
    <?php endif; ?>
    <div class="er"<?=$errors ? "" : ' style="display:none"'?>><?php foreach($errors as $e): ?><div><?=htmlspecialcharsbx(strip_tags($e))?></div><?php endforeach; ?></div>
    <input type="text" name="user_name" placeholder="Ваше имя *" value="<?=htmlspecialcharsbx($arResult["AUTHOR_NAME"])?>" required>
    <input type="tel" name="phone" placeholder="+7 (___) ___-__-__ *" value="<?=$phone?>" required>
    <?php if($hero): ?>
      <input type="text" name="MESSAGE" placeholder="<?=htmlspecialcharsbx($arParams["MESSAGE_PLACEHOLDER"] ?? "Что нужно сделать? (необязательно)")?>" value="<?=htmlspecialcharsbx($arResult["MESSAGE"])?>">
    <?php else: ?>
      <textarea name="MESSAGE" placeholder="<?=htmlspecialcharsbx($arParams["MESSAGE_PLACEHOLDER"] ?? "Ваш вопрос *")?>"<?=$msgReq ? " required" : ""?>><?=htmlspecialcharsbx($arResult["MESSAGE"])?></textarea>
    <?php endif; ?>
    <label class="ag"><input type="checkbox" name="agree" value="Y" required><span>Я даю <a href="/consent/" target="_blank">согласие на обработку персональных данных</a> и принимаю <a href="/privacy/" target="_blank">Политику конфиденциальности</a></span></label>
    <button class="<?=$hero ? "btn" : "sbt"?>" type="submit"><?=htmlspecialcharsbx($arParams["BUTTON_TEXT"] ?? ($hero ? "Вызвать мастера" : "Отправить"))?></button>
  </div>
  <div class="ok"<?=$isOk ? ' style="display:block"' : ""?>><?=htmlspecialcharsbx($isOk ? $arResult["OK_MESSAGE"] : ($arParams["OK_TEXT"] ?? "Спасибо! Заявка принята."))?></div>
</form>
