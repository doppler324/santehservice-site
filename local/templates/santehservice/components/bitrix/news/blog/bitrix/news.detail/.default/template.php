<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arResult */
$this->setFrameMode(true);
$rt = $arResult["DISPLAY_PROPERTIES"]["READ_TIME"]["VALUE"] ?? "";
$pic = $arResult["DETAIL_PICTURE"]["SRC"] ?? "/local/templates/.default/images/blog-hero.jpg";
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
        <?= $arResult["DETAIL_TEXT"] ?>
    </article>

    <a class="bd-back" href="<?= $arResult["LIST_PAGE_URL"] ?>">← Все статьи блога</a>
</div>
