/* Всплывающая форма «Заказать звонок»: открывается по [data-callback] (в шапке — кнопка-трубка) */
(function(){
  var m=document.getElementById('callback'); if(!m) return;
  function open(){
    var f=m.querySelector('form');
    if(f){ var fl=f.querySelector('.fields'), ok=f.querySelector('.ok'), er=f.querySelector('.er'); if(fl) fl.style.display=''; if(ok) ok.style.display=''; if(er){er.style.display='';er.innerHTML='';} }
    m.classList.add('on'); document.documentElement.style.overflow='hidden';
    var i=m.querySelector('input[data-f=name]'); if(i) setTimeout(function(){i.focus()},50);
  }
  function close(){ m.classList.remove('on'); document.documentElement.style.overflow=''; if(location.hash==='#callback') history.replaceState(null,'',location.pathname+location.search); }
  document.addEventListener('click',function(e){
    if(e.target.closest('[data-callback]')){ e.preventDefault(); open(); return; }
    if(m.classList.contains('on') && (e.target===m || e.target.closest('.cbm-x'))){ e.preventDefault(); close(); }
  });
  document.addEventListener('keydown',function(e){ if(e.key==='Escape' && m.classList.contains('on')) close(); });
})();
