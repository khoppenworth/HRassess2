const EPSS_BASE='https://YOUR-EPSS-URL';
function getAuthType(){return{"type":"NONE"};}
function getConfig(){return{"configParams":[]};}
function getSchema(){return{"schema":[{"name":"date","label":"Date","dataType":"STRING"},{"name":"form","label":"Form","dataType":"STRING"},{"name":"avg_score","label":"Avg Score","dataType":"NUMBER"},{"name":"responses","label":"Responses","dataType":"NUMBER"}]};}
function getData(request){const res=UrlFetchApp.fetch(EPSS_BASE+'/analytics/summary.json.php',{muteHttpExceptions:true}); const rows=JSON.parse(res.getContentText()); return {"schema":getSchema().schema,"rows":rows.map(r=>({"values":[String(r.date),String(r.form),Number(r.avg_score),Number(r.responses)]}))};}
