<?php require_once __DIR__.'/../../config.php'; require_once __DIR__.'/../../helpers.php'; include __DIR__.'/../../templates/header.php'; ?>
<h2>API Docs</h2><ul>
<li><code>/api/fhir/Questionnaire</code>, <code>/api/fhir/Questionnaire?id=1</code></li>
<li><code>/api/fhir/QuestionnaireResponse?assessment_id=1</code></li>
<li><code>/api/fhir/Organization</code>, <code>/api/fhir/Practitioner</code></li>
<li><code>/api/export/assessments.csv.php</code>, <code>/api/export/assessments.json.php</code></li></ul>
<p>Auth: <code>Authorization: Bearer &lt;token&gt;</code></p><?php include __DIR__.'/../../templates/footer.php'; ?>
