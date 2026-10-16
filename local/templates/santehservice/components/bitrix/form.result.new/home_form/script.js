/* Отправка веб-формы без перезагрузки; без JS работает обычным POST + редирект (?formresult=addok) */
(function(){
  /* Российский номер: +7 (XXX) XXX-XX-XX; код города/оператора начинается с 3, 4, 5 или 9 */
  function digits10(v){
    var s=String(v), d=s.replace(/\D/g,'');
    if(/^\s*\+7/.test(s)) d=d.slice(1); else if(d.charAt(0)==='7'||d.charAt(0)==='8') d=d.slice(1);
    if(d.charAt(0)==='7'||d.charAt(0)==='8') d=d.slice(1); /* лишние +7 / 8 после готового префикса */
    return d.slice(0,10);
  }
  function fmt(d){
    if(!d) return '';
    var o='+7 ('+d.slice(0,3);
    if(d.length>=3) o+=') '+d.slice(3,6);
    if(d.length>=6) o+='-'+d.slice(6,8);
    if(d.length>=8) o+='-'+d.slice(8,10);
    return o;
  }
  function validPhone(v){ var d=digits10(v); return d.length===10 && /[3459]/.test(d.charAt(0)); }
  function maskPhone(inp){
    inp.setAttribute('maxlength','18'); inp.setAttribute('inputmode','tel'); inp.setAttribute('autocomplete','tel');
    inp.addEventListener('focus',function(){ if(!inp.value) inp.value='+7 ('; });
    inp.addEventListener('blur',function(){ if(!digits10(inp.value)) inp.value=''; });
    inp.addEventListener('input',function(){ var d=digits10(inp.value); inp.value=d?fmt(d):(document.activeElement===inp?'+7 (':''); });
    inp.addEventListener('keydown',function(e){
      if(e.key==='Backspace' && inp.selectionStart===inp.selectionEnd && inp.selectionEnd===inp.value.length){
        e.preventDefault(); var d=digits10(inp.value); inp.value=d.length>1?fmt(d.slice(0,-1)):'+7 (';
        if(d.length<=1) inp.value='+7 (';
      }
    });
  }
  function init(){
    document.querySelectorAll('form[data-hmf]').forEach(function(f){
      if(f.__hmf) return; f.__hmf=1;
      var ph=f.querySelector('[data-f=phone]'); if(ph) maskPhone(ph);
      f.addEventListener('submit',function(e){
        var er=f.querySelector('.er'), fields=f.querySelector('.fields'), ok=f.querySelector('.ok'), btn=f.querySelector('button[type=submit]');
        function q(n){ return f.querySelector('[data-f='+n+']'); }
        function showErr(list){ er.innerHTML=''; list.forEach(function(t){var d=document.createElement('div');d.textContent=t;er.appendChild(d)}); er.style.display=list.length?'block':'none'; }
        var errs=[], msg=q('msg');
        if(!q('name').value.trim()) errs.push('Укажите имя');
        if(!validPhone(q('phone').value)) errs.push('Укажите российский номер полностью: +7 (9XX) XXX-XX-XX');
        if(msg && msg.required && !msg.value.trim()) errs.push('Напишите ваш вопрос');
        if(!q('agree').checked) errs.push('Нужно согласие на обработку персональных данных');
        e.preventDefault(); showErr(errs); if(errs.length) return;
        if(!window.fetch||!window.FormData){ f.submit(); return; }
        btn.disabled=true;
        fetch(f.getAttribute('action')||location.href,{method:'POST',body:new FormData(f),credentials:'same-origin'})
          .then(function(r){ return r.text().then(function(t){ return {url:r.url,html:t}; }); })
          .then(function(res){
            if(res.url.indexOf('formresult=addok')>-1){ fields.style.display='none'; ok.style.display='block'; return; }
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
