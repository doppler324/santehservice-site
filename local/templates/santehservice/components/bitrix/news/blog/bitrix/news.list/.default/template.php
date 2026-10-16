<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @var CBitrixComponentTemplate $this */
$this->setFrameMode(true);

if (empty($arResult["ITEMS"])) {
    echo '<p class="bl-empty">В этой рубрике пока нет статей.</p>';
    return;
}

$page = !empty($arResult["NAV_RESULT"]) ? (int)$arResult["NAV_RESULT"]->NavPageNomer : 1;

// Названия рубрик для меток на карточках (один запрос на страницу)
$ids = array_values(array_unique(array_filter(array_column($arResult["ITEMS"], "IBLOCK_SECTION_ID"))));
$sections = [];
if ($ids) {
    $rs = CIBlockSection::GetList([], ["IBLOCK_ID" => $arParams["IBLOCK_ID"], "ID" => $ids], false, ["ID", "NAME"]);
    while ($s = $rs->Fetch()) $sections[$s["ID"]] = $s["NAME"];
}

$img = function (array $item, int $w, int $h): string {
    $p = !empty($item["PREVIEW_PICTURE"]) ? $item["PREVIEW_PICTURE"] : ($item["DETAIL_PICTURE"] ?? null);
    if (empty($p["ID"])) return "";
    $r = CFile::ResizeImageGet($p["ID"], ["width" => $w, "height" => $h], BX_RESIZE_IMAGE_EXACT, true);
    return $r["src"] ?? $p["SRC"];
};
$meta = function (array $item, bool $views = false): string {
    $h = '<div class="bl-mt">';
    if (!empty($item["DISPLAY_ACTIVE_FROM"])) $h .= '<span class="i-cal">' . $item["DISPLAY_ACTIVE_FROM"] . '</span>';
    $rt = $item["DISPLAY_PROPERTIES"]["READ_TIME"]["VALUE"] ?? "";
    if ($rt) $h .= '<span class="i-clock">' . htmlspecialcharsbx($rt) . ' мин</span>';
    if ($views && !empty($item["SHOW_COUNTER"])) $h .= '<span class="i-eye">' . number_format((int)$item["SHOW_COUNTER"], 0, "", " ") . '</span>';
    return $h . '</div>';
};
$edit = function (array $item) use ($arParams) {
    $this->AddEditAction($item["ID"], $item["EDIT_LINK"], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($item["ID"], $item["DELETE_LINK"], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), ["CONFIRM" => "Удалить статью?"]);
    return $this->GetEditAreaId($item["ID"]);
};

$items = $arResult["ITEMS"];
$featured = ($page === 1 && empty($arParams["PARENT_SECTION_CODE"])) ? array_shift($items) : null;
?>

<?php if ($featured): $src = $img($featured, 900, 700); ?>
<a class="bl-feat" id="<?= $edit($featured) ?>" href="<?= $featured["DETAIL_PAGE_URL"] ?>">
    <div class="bl-im" style="<?= $src ? "background-image:url('" . $src . "')" : "" ?>"></div>
    <div class="bl-feat__bd">
        <span class="bl-lb">НОВОЕ В БЛОГЕ</span>
        <h2><?= $featured["NAME"] ?></h2>
        <?php if (!empty($featured["PREVIEW_TEXT"])): ?><p><?= TruncateText(strip_tags($featured["PREVIEW_TEXT"]), 220) ?></p><?php endif ?>
        <?= $meta($featured, true) ?>
        <span class="bl-btn">Читать статью</span>
    </div>
</a>
<?php endif ?>

<h2 class="bl-sec">Последние статьи</h2>
<div class="bl-grid">
<?php foreach ($items as $i => $item): $src = $img($item, 700, 380); ?>
    <?php if ($i === 6): ?>
    <div class="bl-cta"><div><b>Нужна помощь сантехника?</b><span>Мастер приедет за 30 минут, назовёт цену до начала работ и даст гарантию до 3 лет.</span></div><a class="bl-btn" href="/#order">Вызвать мастера</a></div>
    <?php endif ?>
    <a class="bl-card" id="<?= $edit($item) ?>" href="<?= $item["DETAIL_PAGE_URL"] ?>">
        <div class="bl-im" style="<?= $src ? "background-image:url('" . $src . "')" : "" ?>">
            <?php if (!empty($sections[$item["IBLOCK_SECTION_ID"]])): ?><em><?= htmlspecialcharsbx(mb_strtoupper($sections[$item["IBLOCK_SECTION_ID"]])) ?></em><?php endif ?>
        </div>
        <div class="bl-card__bd">
            <b><?= $item["NAME"] ?></b>
            <?php if (!empty($item["PREVIEW_TEXT"])): ?><p><?= TruncateText(strip_tags($item["PREVIEW_TEXT"]), 120) ?></p><?php endif ?>
            <?= $meta($item) ?>
        </div>
    </a>
<?php endforeach ?>
</div>
<?php if ($arParams["DISPLAY_BOTTOM_PAGER"]): ?><?= $arResult["NAV_STRING"] ?><?php endif ?>
