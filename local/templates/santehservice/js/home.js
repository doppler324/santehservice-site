/* СантехСервис: скрипты главной (подключается в <head>, поэтому ждём DOM) */
document.addEventListener("DOMContentLoaded",function(){
(function(){
 // вкладки услуг
 var tb=document.querySelectorAll('.tabs button'),pn=document.querySelectorAll('.sv');
 tb.forEach(function(b){b.addEventListener('click',function(){
  tb.forEach(function(x){x.classList.toggle('a',x===b)});
  pn.forEach(function(p){p.classList.toggle('a',p.getAttribute('data-p')===b.getAttribute('data-t'))});
 })});
 // слайдер отзывов
 var t=document.getElementById('rt'),d=document.querySelectorAll('#rd i'),n=d.length,k=0;
 function go(i){k=(i+n)%n;t.style.transform='translateX(-'+k*100+'%)';d.forEach(function(x,j){x.classList.toggle('a',j===k)})}
 document.getElementById('rp').onclick=function(){go(k-1)};
 document.getElementById('rn').onclick=function(){go(k+1)};
 d.forEach(function(x,j){x.onclick=function(){go(j)}});
})();

 // переход с других страниц по ссылке вида /#services: после загрузки картинок докручиваем до блока (учитывается scroll-padding)
 window.addEventListener('load',function(){
  if(!location.hash||location.hash.length<2)return;
  var el=document.getElementById(decodeURIComponent(location.hash.slice(1)));
  if(el)setTimeout(function(){el.scrollIntoView()},150);
 });
});
