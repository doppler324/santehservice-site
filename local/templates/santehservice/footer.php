</main>

    <?// Используем кастомный цвет фона для точного совпадения с макетом ?>
    <footer class="bg-[#11459a] text-white pt-10 pb-10 xl:pt-12 xl:pb-12 mt-auto">
        
        <?// Широкий контейнер, аналогичный шапке ?>
        <div class="max-w-[1536px] mx-auto px-4 xl:px-8 flex flex-col lg:flex-row items-start justify-between gap-10 lg:gap-6">
            
            <?// 1. Логотип и текст ?>
            <div class="flex flex-col gap-3.5 flex-shrink-0 lg:max-w-[320px]">
                <div class="flex items-center gap-3.5">
                    <?// Иконка капли (Белая) ?>
                    <div class="flex-shrink-0">
                        <svg viewBox="0 0 24 24" fill="currentColor" class="w-[38px] h-[38px] text-white">
                            <path d="M12 2.694c-2.316 2.646-7 8.243-7 12.03 0 3.866 3.134 7 7 7s7-3.134 7-7c0-3.787-4.684-9.384-7-12.03z"/>
                        </svg>
                    </div>
                    <?// Название компании ?>
                    <div class="font-bold text-[26px] leading-none tracking-tight">
                        СантехСервис
                    </div>
                </div>
                <?// Подзаголовок ?>
                <div class="text-[14px] text-white/80 leading-snug">
                    Профессиональные сантехнические услуги<br>
                    в Москве и области
                </div>
            </div>

            <?// 2. Навигация ?>
            <div class="flex flex-col gap-3.5 text-[15px] font-medium">
                <a href="/#services" class="hover:text-white/70 transition-colors">Услуги</a>
                <a href="/#prices" class="hover:text-white/70 transition-colors">Цены</a>
                <a href="/#reviews" class="hover:text-white/70 transition-colors">Отзывы</a>
                <a href="#contacts" class="hover:text-white/70 transition-colors">Контакты</a>
            </div>

            <?// 3. Контактная информация ?>
            <div class="flex flex-col gap-4 text-[15px] font-medium">
                <?// Телефон ?>
                <div class="flex items-center gap-3">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-[22px] h-[22px] text-white/80 flex-shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.896-1.596-5.54-4.24-7.136-7.136l1.292-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                    </svg>
                    <a href="tel:+74957773679" class="hover:text-white/70 transition-colors">+7 (495) 777-36-79</a>
                </div>
                <?// Почта ?>
                <div class="flex items-center gap-3">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-[22px] h-[22px] text-white/80 flex-shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                    </svg>
                    <a href="mailto:info@uslugi-santechnika.ru" class="hover:text-white/70 transition-colors">info@uslugi-santechnika.ru</a>
                </div>
                <?// Адрес ?>
                <div class="flex items-center gap-3">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-[22px] h-[22px] text-white/80 flex-shrink-0">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                    </svg>
                    <span>г. Москва, ул. Лесная, д. 7</span>
                </div>
            </div>

            <?// 4. Соцсети и копирайт ?>
            <div class="flex flex-col items-start lg:items-end gap-6 flex-shrink-0">
                
                <?// Иконки соцсетей ?>
                <div class="flex items-center gap-3 lg:pr-1">
                    <?// VK ?>
                    <a href="#" class="w-11 h-11 rounded-full bg-white/10 hover:bg-white/20 transition-colors flex items-center justify-center">
                        <span class="text-[13px] font-bold">VK</span>
                    </a>
                    <?// Telegram ?>
                    <a href="#" class="w-11 h-11 rounded-full bg-white/10 hover:bg-white/20 transition-colors flex items-center justify-center">
                        <svg viewBox="0 0 24 24" fill="currentColor" class="w-[22px] h-[22px]">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm4.64 6.8c-.15 1.58-.8 5.42-1.13 7.19-.14.75-.42 1-.68 1.03-.58.05-1.02-.38-1.58-.75-.88-.58-1.38-.94-2.23-1.5-.99-.65-.35-1.01.22-1.59.15-.15 2.71-2.48 2.76-2.69.01-.03.01-.14-.07-.19-.07-.05-.17-.03-.25-.01-.11.02-1.93 1.23-5.46 3.62-.51.35-.98.53-1.4.51-.46-.03-1.35-.26-2.01-.48-.81-.27-1.46-.42-1.4-.88.03-.24.36-.49 1-.76 3.91-1.7 6.52-2.82 7.82-3.36 3.73-1.56 4.51-1.83 5.02-1.84.11 0 .37.03.5.15.11.1.15.22.16.35-.01.12-.02.26-.04.38z"/>
                        </svg>
                    </a>
                </div>
                
            </div>
            
        </div>
        <?// Нижняя строка: обязательные документы и копирайт ?>
        <div class="max-w-[1536px] mx-auto px-4 xl:px-8 mt-8 pt-6 border-t border-white/20 flex flex-col lg:flex-row lg:items-center justify-between gap-4 text-[13px]">
            <div class="flex flex-wrap gap-x-6 gap-y-2">
                <a href="/privacy/" class="hover:text-white/70 transition-colors">Политика конфиденциальности</a>
                <a href="/consent/" class="hover:text-white/70 transition-colors">Согласие на обработку персональных данных</a>
                <a href="/terms/" class="hover:text-white/70 transition-colors">Пользовательское соглашение</a>
                <a href="/offer/" class="hover:text-white/70 transition-colors">Публичная оферта</a>
                <a href="/cookies/" class="hover:text-white/70 transition-colors">Политика cookies</a>
                <a href="/requisites/" class="hover:text-white/70 transition-colors">Реквизиты</a>
            </div>
            <div class="text-white/70">© <?=date("Y")?> СантехСервис. Все права защищены.</div>
        </div>
    </footer>

    <?// Здесь могут быть подключены ваши основные скрипты ?>
    <script src="<?=SITE_TEMPLATE_PATH?>/js/main.js"></script>
</body>
</html>