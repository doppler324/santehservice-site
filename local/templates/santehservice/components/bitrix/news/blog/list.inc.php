<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @var CBitrixComponent $component */

$sectionCode = $arResult["VARIABLES"]["SECTION_CODE"] ?? "";
$folder = $arResult["FOLDER"];

// Поиск по статьям: ?q=слово. Каждое слово ищется в названии, анонсе и тексте (с простым отсечением окончаний), слова связаны через «И»
$q = trim(preg_replace('~\s+~u', " ", strip_tags((string)($_GET["q"] ?? ""))));
$q = mb_substr($q, 0, 100);
$blogFilter = [];
if ($q !== "") {
    $blogFilter = ["LOGIC" => "AND"];
    foreach (array_slice(array_filter(explode(" ", $q), function ($w) { return mb_strlen($w) >= 2; }), 0, 6) as $w) {
        $l = mb_strlen($w); $w = $l >= 7 ? mb_substr($w, 0, -2) : ($l >= 5 ? mb_substr($w, 0, -1) : $w);
        $blogFilter[] = ["LOGIC" => "OR", "%NAME" => $w, "%PREVIEW_TEXT" => $w, "%DETAIL_TEXT" => $w];
    }
    if (count($blogFilter) === 1) $blogFilter = ["ID" => 0]; // запрос из одних коротких слов — ничего не показываем
}
$GLOBALS["blogFilter"] = $blogFilter;
$formAction = $folder . ($sectionCode ? $sectionCode . "/" : "");

// Рубрики (разделы инфоблока) со счётчиками
$chips = [];
$total = 0;
$rs = CIBlockSection::GetList(
    ["SORT" => "ASC", "NAME" => "ASC"],
    ["IBLOCK_ID" => $arParams["IBLOCK_ID"], "ACTIVE" => "Y", "GLOBAL_ACTIVE" => "Y", "CNT_ACTIVE" => "Y"],
    true,
    ["ID", "NAME", "CODE"]
);
while ($s = $rs->Fetch()) {
    $chips[] = $s;
    $total += (int)$s["ELEMENT_CNT"];
}
?>
<div class="bl">
    <div class="bl-bc"><a href="/">Главная</a><i>/</i><?php if ($sectionCode): ?><a href="<?= $folder ?>">Блог</a><i>/</i><b><?php $APPLICATION->ShowTitle(false) ?></b><?php else: ?><b>Блог</b><?php endif ?></div>

    <section class="bl-cover">
        <div class="bl-cover__tx">
            <span class="bl-tag">БЛОГ СантехСервис</span>
            <h1><?= $sectionCode ? $APPLICATION->GetTitle() : "Полезные статьи о сантехнике" ?></h1>
            <p>Советы мастеров, инструкции и обзоры: как устранить неисправность самому и когда лучше вызвать специалиста.</p>
            <form class="bl-sf" action="<?= $formAction ?>" method="get" role="search">
                <input type="text" name="q" value="<?= htmlspecialcharsbx($q) ?>" placeholder="Поиск по статьям" autocomplete="off" aria-label="Поиск по статьям">
                <button type="submit">Найти</button>
            </form>
        </div>
        <img src="/local/templates/.default/images/blog-hero.jpg" alt="">
    </section>

    <?php if ($chips): ?>
    <div class="bl-chips">
        <a href="<?= $folder ?>" class="<?= $sectionCode ? "" : "a" ?>">Все статьи<small><?= $total ?></small></a>
        <?php foreach ($chips as $c): ?>
            <a href="<?= $folder . $c["CODE"] ?>/" class="<?= $c["CODE"] === $sectionCode ? "a" : "" ?>"><?= htmlspecialcharsbx($c["NAME"]) ?><small><?= (int)$c["ELEMENT_CNT"] ?></small></a>
        <?php endforeach ?>
    </div>
    <?php endif ?>

    <?php
    $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        ".default",
        [
            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
            "IBLOCK_ID" => $arParams["IBLOCK_ID"],
            "FILTER_NAME" => "blogFilter",
            "NEWS_COUNT" => $arParams["NEWS_COUNT"],
            "SORT_BY1" => $arParams["SORT_BY1"],
            "SORT_ORDER1" => $arParams["SORT_ORDER1"],
            "SORT_BY2" => $arParams["SORT_BY2"],
            "SORT_ORDER2" => $arParams["SORT_ORDER2"],
            "FIELD_CODE" => $arParams["LIST_FIELD_CODE"],
            "PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
            "ACTIVE_DATE_FORMAT" => $arParams["LIST_ACTIVE_DATE_FORMAT"],
            "DETAIL_URL" => $folder . $arResult["URL_TEMPLATES"]["detail"],
            "SECTION_URL" => $folder . $arResult["URL_TEMPLATES"]["section"],
            "IBLOCK_URL" => $folder . $arResult["URL_TEMPLATES"]["news"],
            "PARENT_SECTION" => "",
            "PARENT_SECTION_CODE" => $sectionCode,
            "INCLUDE_SUBSECTIONS" => "Y",
            "CHECK_DATES" => $arParams["CHECK_DATES"],
            "DISPLAY_TOP_PAGER" => "N",
            "DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
            "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
            "PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
            "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
            "PAGER_TITLE" => $arParams["PAGER_TITLE"],
            "SET_TITLE" => "N",
            "ADD_SECTIONS_CHAIN" => "N",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
            "SET_STATUS_404" => $arParams["SET_STATUS_404"],
            "SHOW_404" => $arParams["SHOW_404"],
            "MESSAGE_404" => $arParams["MESSAGE_404"],
            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
            "CACHE_TIME" => $arParams["CACHE_TIME"],
            "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
			"FILE_404" => $arParams["FILE_404"],
        ],
        $component
    );
    ?>
</div>
