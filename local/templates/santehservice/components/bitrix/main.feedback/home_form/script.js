/* Отправка форм home_form без перезагрузки; без JS работает обычным POST + редирект (?success=...) */
(function(){
  function init(){
    document.querySelectorAll('form[data-hmf]').forEach(function(f){
      if(f.__hmf) return; f.__hmf=1;
      f.addEventListener('submit',function(e){
        var er=f.querySelector('.er'), fields=f.querySelector('.fields'), ok=f.querySelector('.ok'), btn=f.querySelector('button[type=submit]');
        function showErr(list){ er.innerHTML=''; list.forEach(function(t){var d=document.createElement('div');d.textContent=t;er.appendChild(d)}); er.style.display=list.length?'block':'none'; }
        var name=f.elements.user_name.value.trim(), ph=f.elements.phone.value.replace(/\D/g,''), agree=f.elements.agree.checked, msg=f.elements.MESSAGE;
        var errs=[];
        if(!name) errs.push('Укажите имя');
        if(ph.length<10) errs.push('Укажите телефон полностью');
        if(msg && msg.required && !msg.value.trim()) errs.push('Напишите ваш вопрос');
        if(!agree) errs.push('Нужно согласие на обработку персональных данных');
        e.preventDefault(); showErr(errs); if(errs.length) return;
        if(!window.fetch||!window.FormData){ f.submit(); return; }
        btn.disabled=true;
        fetch(f.getAttribute('action')||location.href,{method:'POST',body:new FormData(f),credentials:'same-origin'})
          .then(function(r){ return r.text().then(function(t){ return {url:r.url,html:t}; }); })
          .then(function(res){
            if(res.url.indexOf('success='+f.getAttribute('data-hmf'))>-1){ fields.style.display='none'; ok.style.display='block'; if(!ok.textContent.trim()) ok.textContent='Спасибо! Заявка принята.'; return; }
            var doc=new DOMParser().parseFromString(res.html,'text/html'), srv=doc.querySelector('#'+f.id+' .er'), list=[];
            if(srv) srv.querySelectorAll('div').forEach(function(d){list.push(d.textContent)});
            showErr(list.length?list:['Не удалось отправить заявку. Позвоните нам или попробуйте позже.']);
          })
          .catch(function(){ showErr(['Нет связи с сервером. Попробуйте ещё раз.']); })
          .then(function(){ btn.disabled=false; });
      });
    });
  }
  if(document.readyState==='loading') document.addEventListener('DOMContentLoaded',init); else init();
})();
