<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arResult */
if (empty($arResult)) return;
?>
<!-- Навигация -->
<nav class="hidden lg:flex items-center gap-6 xl:gap-8">
<?php foreach ($arResult as $item): ?>
    <?php if ($item["DEPTH_LEVEL"] > 1) continue; ?>
    <a href="<?= htmlspecialcharsbx($item["LINK"]) ?>"
       class="<?= $item["SELECTED"] ? "text-brand-blue" : "text-brand-dark" ?> font-semibold text-[15px] hover:text-brand-blue transition-colors"<?= $item["SELECTED"] ? ' aria-current="page"' : "" ?>><?= htmlspecialcharsbx($item["TEXT"]) ?></a>
<?php endforeach ?>
</nav>
