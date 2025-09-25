<?php
require_once __DIR__.'/../config.php'; header('Content-Type: application/json'); echo json_encode(['endpoints'=>['/api/fhir/metadata','/api/fhir/Questionnaire.php?id=','/api/fhir/QuestionnaireResponse.php?id=']]);
?>
