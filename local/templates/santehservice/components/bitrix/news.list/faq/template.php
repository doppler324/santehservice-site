<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="space-y-3">
    <?foreach($arResult["ITEMS"] as $arItem):?>
        <details class="group bg-brand-light rounded-xl overflow-hidden">
            <summary class="flex justify-between items-center p-4 cursor-pointer font-medium text-brand-dark hover:text-brand-blue transition">
                <?=$arItem["NAME"]?>
                <span class="text-brand-blue group-open:rotate-45 transition-transform duration-200">+</span>
            </summary>
            <div class="px-4 pb-4 text-gray-600 text-sm">
                <?=$arItem["PREVIEW_TEXT"]?>
            </div>
        </details>
    <?endforeach;?>
</div>