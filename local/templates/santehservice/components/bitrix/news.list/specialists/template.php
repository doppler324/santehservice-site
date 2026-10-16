<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    <?foreach($arResult["ITEMS"] as $arItem):?>
        <div class="bg-white rounded-2xl overflow-hidden shadow-sm text-center p-6 border border-gray-100">
            <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["NAME"]?>" class="w-24 h-24 rounded-full object-cover mx-auto mb-4">
            <h3 class="font-bold text-lg"><?=$arItem["NAME"]?></h3>
            <p class="text-sm text-gray-500 mb-1">Опыт работы: <?=$arItem["PROPERTIES"]["EXPERIENCE"]["VALUE"]?> лет</p>
            <p class="text-sm text-brand-blue font-medium"><?=$arItem["PROPERTIES"]["SPECIALIZATION"]["VALUE"]?></p>
        </div>
    <?endforeach;?>
</div>