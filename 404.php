<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/urlrewrite.php");
CHTTP::SetStatus("404 Not Found");
@define("ERROR_404", "Y");
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Страница не найдена");
?>
<section class="max-w-3xl mx-auto px-6 py-20 text-center">
    <div class="text-brand-blue font-extrabold text-8xl leading-none">404</div>
    <h1 class="text-brand-dark font-extrabold text-3xl mt-6">Страница не найдена</h1>
    <p class="text-gray-500 mt-4">Возможно, адрес изменился или страница была удалена. Перейдите на главную.</p>
    <div class="flex flex-wrap gap-3 justify-center mt-8">
        <a href="/" class="bg-brand-blue text-white font-bold rounded-lg px-6 py-3">На главную</a>
    </div>
</section>
<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
