<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    <?foreach($arResult["ITEMS"] as $arItem):?>
        <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition group">
            <div class="h-48 overflow-hidden">
                <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["NAME"]?>" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
            </div>
            <div class="p-5">
                <h3 class="font-bold text-lg mb-2"><?=$arItem["NAME"]?></h3>
                <div class="text-brand-blue font-bold text-xl mb-4">от <?=$arItem["PROPERTIES"]["PRICE"]["VALUE"]?> ₽</div>
                <button class="w-full bg-brand-yellow text-brand-dark font-medium py-2 rounded-lg hover:bg-yellow-400 transition">Заказать</button>
            </div>
        </div>
    <?endforeach;?>
</div>