<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<form action="<?=POST_FORM_ACTION_URI?>" method="POST" class="space-y-4">
    <?=bitrix_sessid_post()?>
    <div>
        <input type="text" name="user_name" placeholder="Ваше имя *" required class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-brand-blue focus:ring-1 focus:ring-brand-blue outline-none transition text-sm">
    </div>
    <div>
        <input type="tel" name="user_phone" placeholder="+7 (___) ___-__-__ *" required class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-brand-blue focus:ring-1 focus:ring-brand-blue outline-none transition text-sm">
    </div>
    <div>
        <textarea name="MESSAGE" placeholder="Что нужно сделать? (необязательно)" rows="2" class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-brand-blue focus:ring-1 focus:ring-brand-blue outline-none transition text-sm resize-none"></textarea>
    </div>
    <input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
    <button type="submit" name="submit" class="w-full bg-brand-yellow text-brand-dark font-bold py-3 rounded-lg hover:bg-yellow-400 transition">Вызвать мастера</button>
    <p class="text-[10px] text-gray-400 text-center leading-tight">Нажимая кнопку, вы соглашаетесь с <a href="#" class="underline">политикой конфиденциальности</a></p>
</form>