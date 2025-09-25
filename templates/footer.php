<?php // footer ?>
</div></main><footer><div class="container muted">EPSS • FHIR & Looker exports • Drop AdminLTE into /public/vendor/adminlte</div></footer>
<script src="/vendor/adminlte/js/adminlte.min.js"></script>
<script>function drawBarChart(id,labels,values){const c=document.getElementById(id);if(!c)return;const x=c.getContext('2d');const W=c.width=c.offsetWidth,H=c.height=240;const m=Math.max(...values,1);const w=Math.max(20,(W-40)/values.length-10);x.clearRect(0,0,W,H);x.font='12px system-ui';labels.forEach((lab,i)=>{const X=20+i*(w+10);const h=(values[i]/m)*(H-60);const Y=H-30-h;x.fillStyle='#6aa8ff';x.fillRect(X,Y,w,h);x.fillStyle='#333';x.fillText(lab,X,H-12);});}</script>
</body></html>
