<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arResult */
$this->setFrameMode(true);
$rt = $arResult["DISPLAY_PROPERTIES"]["READ_TIME"]["VALUE"] ?? "";
$pic = $arResult["DETAIL_PICTURE"]["SRC"] ?? "/local/templates/.default/images/blog-hero.jpg";
// кнопки-заглушки внутри текста статьи (блок .cta): «Заказать звонок» открывает всплывающую форму, остальные («Вызвать мастера») ведут к форме в футере
$text = preg_replace_callback('~(<a\b[^>]*>)(.*?)</a>~usi', function ($m) {
    $tag = $m[1];
    if (!preg_match('~\bclass="[^"]*\bbtn\b~u', $tag)) return $m[0];
    if (!preg_match('~\bhref="([^"]*)"~u', $tag, $h)) return $m[0];
    if (!in_array(trim($h[1]), array("", "#", "#order", "/#order", "/#contacts", "#contacts", "/kontakty/"), true)) return $m[0];
    $call = mb_stripos(strip_tags($m[2]), "звонок") !== false || mb_stripos(strip_tags($m[2]), "перезвон") !== false;
    $tag = preg_replace('~\bhref="[^"]*"~u', 'href="' . ($call ? "#callback" : "#contacts") . '"', $tag, 1);
    if ($call && strpos($tag, "data-callback") === false) $tag = preg_replace('~^<a\b~u', '<a data-callback', $tag, 1);
    return $tag . $m[2] . "</a>";
}, (string)$arResult["DETAIL_TEXT"]);
?>
<div class="bd-wrap">
    <div class="bd-bc"><a href="/">Главная</a><i>/</i><a href="<?= $arResult["LIST_PAGE_URL"] ?>">Блог</a><i>/</i><b><?= $arResult["NAME"] ?></b></div>
    <section class="bd-cover">
        <div class="bd-cover__tx">
            <?php if (!empty($arResult["SECTION"]["PATH"])): $sec = end($arResult["SECTION"]["PATH"]); ?><span class="bd-tag"><?= mb_strtoupper(htmlspecialcharsbx($sec["NAME"])) ?></span><?php endif ?>
            <h1><?= $arResult["NAME"] ?></h1>
            <div class="bd-meta">
                <?php if (!empty($arResult["DISPLAY_ACTIVE_FROM"])): ?><span><?= $arResult["DISPLAY_ACTIVE_FROM"] ?></span><?php endif ?>
                <?php if ($rt): ?><span><?= htmlspecialcharsbx($rt) ?> мин чтения</span><?php endif ?>
                <?php if (!empty($arResult["SHOW_COUNTER"])): ?><span><?= number_format((int)$arResult["SHOW_COUNTER"], 0, "", " ") ?> просмотров</span><?php endif ?>
            </div>
        </div>
        <img src="<?= $pic ?>" alt="<?= htmlspecialcharsbx($arResult["NAME"]) ?>">
    </section>

    <article>
        <?php if (!empty($arResult["PREVIEW_TEXT"])): ?><p class="lead"><?= strip_tags($arResult["PREVIEW_TEXT"]) ?></p><?php endif ?>
        <?= $text ?>
    </article>

    <a class="bd-back" href="<?= $arResult["LIST_PAGE_URL"] ?>">← Все статьи блога</a>
</div>
