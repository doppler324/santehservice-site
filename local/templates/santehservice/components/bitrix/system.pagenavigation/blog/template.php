<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arResult */
if (!$arResult["NavShowAlways"]) {
    if ($arResult["NavRecordCount"] == 0 || ($arResult["NavPageCount"] == 1 && $arResult["NavShowAll"] == false)) return;
}
$qs = $arResult["NavQueryString"] != "" ? htmlspecialcharsbx($arResult["NavQueryString"]) . "&amp;" : "";
$url = $arResult["sUrlPath"];
$n = $arResult["NavNum"];
?>
<nav class="bl-pg">
    <?php if ($arResult["NavPageNomer"] > 1): ?>
        <a class="n" href="<?= $url ?>?<?= $qs ?>PAGEN_<?= $n ?>=<?= $arResult["NavPageNomer"] - 1 ?>">← Назад</a>
    <?php endif ?>
    <?php for ($p = $arResult["nStartPage"]; $p <= $arResult["nEndPage"]; $p++): ?>
        <?php if ($p == $arResult["NavPageNomer"]): ?><a class="a"><?= $p ?></a>
        <?php elseif ($p == 1): ?><a href="<?= $url ?><?= $arResult["NavQueryString"] != "" ? "?" . htmlspecialcharsbx($arResult["NavQueryString"]) : "" ?>"><?= $p ?></a>
        <?php else: ?><a href="<?= $url ?>?<?= $qs ?>PAGEN_<?= $n ?>=<?= $p ?>"><?= $p ?></a><?php endif ?>
    <?php endfor ?>
    <?php if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]): ?>
        <a class="n" href="<?= $url ?>?<?= $qs ?>PAGEN_<?= $n ?>=<?= $arResult["NavPageNomer"] + 1 ?>">Вперёд →</a>
    <?php endif ?>
</nav>
