<?php
require_once __DIR__.'/../../config.php'; header('Content-Type: application/fhir+json');
echo json_encode(["resourceType"=>"CapabilityStatement","status"=>"active","date"=>date('c'),"kind"=>"capability","fhirVersion"=>"4.0.1","format"=>["json"],"rest"=>[["mode"=>"server","resource"=>[["type"=>"Questionnaire"],["type"=>"QuestionnaireResponse"]]]]]);
?>
