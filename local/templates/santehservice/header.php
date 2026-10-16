<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
// Стили блока «Контакты» (он выводится в footer.php на всех страницах)
$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/contacts.css");
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-RZ9E1821RR"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-RZ9E1821RR');
</script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?$APPLICATION->ShowTitle()?></title>
    <?$APPLICATION->ShowHead();?>
    
    <!-- Подключение шрифта Inter как на макете -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
	<link rel="icon" type="image/x-icon" sizes="any" href="/favicon.ico">
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
	<link rel="manifest" href="/site.webmanifest">
	<meta name="theme-color" content="#1565e8">
	
    <!-- Tailwind CDN для разработки (в продакшене заменить на скомпилированный style.css) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'brand-blue': '#1c64f2', /* Ярко-синий как на логотипе и кнопке */
                        'brand-dark': '#112a57', /* Темно-синий для пунктов меню и телефона */
                        'brand-yellow': '#ffbc00', /* Желтый для кнопки "Вызвать мастера" */
                        'brand-gray': '#738094', /* Серый для подзаголовков */
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="font-sans text-gray-800 bg-white">
    
    <!-- Панель управления 1С-Битрикс -->
    <div id="panel">
        <?$APPLICATION->ShowPanel();?>
    </div>

    <?// SVG-иконки для блока «Контакты» и главной (подключаются один раз на страницу) ?>
    <?include_once($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/include/svg-sprite.php");?>

    <header class="bg-white shadow-sm sticky top-0 z-50 border-b border-gray-100">
        <!-- Широкий контейнер для соответствия макету -->
        <div class="max-w-[1536px] mx-auto px-4 xl:px-8 py-3.5 flex items-center justify-between gap-4">
            
            <!-- Логотип -->
            <div class="flex items-center gap-3.5 flex-shrink-0">
                <!-- Иконка капли (SVG) -->
                <div class="flex-shrink-0">
                    <svg viewBox="0 0 24 24" fill="currentColor" class="w-[42px] h-[42px] text-brand-blue">
                        <path d="M12 2.694c-2.316 2.646-7 8.243-7 12.03 0 3.866 3.134 7 7 7s7-3.134 7-7c0-3.787-4.684-9.384-7-12.03z"/>
                    </svg>
                </div>
                <!-- Текст логотипа -->
                <div class="flex flex-col justify-center">
                    <a href="/" class="text-brand-blue font-bold text-[24px] leading-[1.1] tracking-tight hover:opacity-90 transition-opacity">
                        СантехСервис
                    </a>
                    <div class="text-[13px] text-brand-gray mt-0.5">Профессиональные сантехнические услуги</div>
                </div>
            </div>
            
            <?
			$APPLICATION->IncludeComponent(
				"bitrix:menu",
				"main_nav",
				[
					"ROOT_MENU_TYPE" => "top",
					"MAX_LEVEL" => "1",
					"CHILD_MENU_TYPE" => "left",
					"USE_EXT" => "N",
					"DELAY" => "N",
					"ALLOW_MULTI_SELECT" => "N",
					"MENU_CACHE_TYPE" => "A",
					"MENU_CACHE_TIME" => "3600",
					"MENU_CACHE_USE_GROUPS" => "Y",
					"MENU_CACHE_GET_VARS" => [],
				],
				false
			);?>

            <!-- Контакты и кнопки -->
            <div class="flex items-center gap-5 xl:gap-7 flex-shrink-0">
                <!-- Блок телефона -->
                <div class="hidden md:flex flex-col">
                    <a href="tel:+74957773679" class="text-brand-dark font-bold text-[19px] leading-[1.1] hover:text-brand-blue transition-colors">
                        +7 (495) 777-36-79
                    </a>
                    <div class="text-[13px] text-brand-gray mt-1">Круглосуточно</div>
                </div>
                
                <!-- Кнопки -->
                <div class="flex items-center gap-3">
                    <a href="#callback" data-callback title="Заказать звонок" aria-label="Заказать звонок" class="flex items-center justify-center w-[44px] h-[44px] rounded-full border-[1.5px] border-brand-blue text-brand-blue hover:bg-brand-blue hover:text-white transition-all duration-300">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-[20px] h-[20px]"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    </a>
                    <a href="#contacts" class="px-6 py-[11px] rounded-full bg-brand-yellow text-white font-semibold text-[14.5px] hover:bg-yellow-500 hover:shadow-md transition-all duration-300">
                        Вызвать мастера
                    </a>
                </div>
            </div>
            
        </div>
    </header>

    <!-- Начало основного контента сайта -->
    <main class="flex-grow">