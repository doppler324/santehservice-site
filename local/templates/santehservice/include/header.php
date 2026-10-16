<?php if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
include_once($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/include/svg-sprite.php"); // иконки (один раз на страницу)
?>
<header class="sh">
<div class="w hd">
 <a class="logo" href="/"><svg style="color:#1565e8"><use href="#hm-drop"/></svg><span><b>СантехСервис</b><small>Профессиональные сантехнические услуги</small></span></a>
 <nav>
  <a href="/#services">Услуги</a><a href="/#prices">Цены</a><a href="/#why">Преимущества</a><a href="/#reviews">Отзывы</a><a href="/#guarantee">Гарантии</a><a href="/blog/">Статьи</a><a href="/#faq">FAQ</a><a href="#contacts">Контакты</a>
 </nav>
 <a class="ph" href="tel:+74957773679">+7 (495) 777-36-79<small>Круглосуточно</small></a>
 <a class="o" href="#contacts">Заказать звонок</a>
 <a class="btn" href="/#order">Вызвать мастера</a>
 <button class="burger" type="button" aria-label="Меню" onclick="document.querySelector('nav').style.cssText=document.querySelector('nav').style.display==='flex'?'':'display:flex;position:absolute;top:68px;left:0;right:0;background:#fff;flex-direction:column;padding:16px 24px;gap:16px;box-shadow:0 8px 20px #0a3a8a22;font-size:14px'"><span></span></button>
</div>
</header>
