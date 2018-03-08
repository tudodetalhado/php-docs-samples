<?php

/**
 * Copyright 2016 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
namespace Google\Cloud\Samples\Dlp;

// [START dlp_create_inspect_template]
use Google\Cloud\Dlp\V2\DlpServiceClient;
use Google\Cloud\Dlp\V2\InfoType;
use Google\Cloud\Dlp\V2\InspectConfig;
use Google\Cloud\Dlp\V2\InspectTemplate;
use Google\Cloud\Dlp\V2\Likelihood;
use Google\Cloud\Dlp\V2\InspectConfig_FindingLimits;

/**
 * Create a new DLP inspection configuration template.
 *
 * @param string $callingProjectId The project ID to run the API call under
 * @param string $templateId The name of the template to be created
 * @param string $displayName Optional The human-readable name to give the template
 * @param string $description Optional A description for the trigger to be created
 * @param int $maxFindings The maximum number of findings to report per request (0 = server maximum)
 */
function create_inspect_template(
    $callingProjectId,
    $templateId,
    $displayName,
    $description,
    $maxFindings
) {
    // Instantiate a client.
    $dlp = new DlpServiceClient();

    // ----- Construct inspection config -----
    // The infoTypes of information to match
    $personNameInfoType = new InfoType();
    $personNameInfoType->setName('PERSON_NAME');
    $usStateInfoType = new InfoType();
    $usStateInfoType->setName('US_STATE');
    $infoTypes = [$personNameInfoType, $usStateInfoType];

    // Whether to include the matching string in the response
    $includeQuote = true;

    // The minimum likelihood required before returning a match
    $minLikelihood = likelihood::LIKELIHOOD_UNSPECIFIED;

    // Specify finding limits
    $limits = new InspectConfig_FindingLimits();
    $limits->setMaxFindingsPerRequest($maxFindings);

    // Create the configuration object
    $inspectConfig = new InspectConfig();
    $inspectConfig->setMinLikelihood($minLikelihood);
    $inspectConfig->setLimits($limits);
    $inspectConfig->setInfoTypes($infoTypes);
    $inspectConfig->setIncludeQuote($includeQuote);

    // Construct inspection template
    $inspectTemplate = new InspectTemplate();
    $inspectTemplate->setInspectConfig($inspectConfig);
    $inspectTemplate->setDisplayName($displayName);
    $inspectTemplate->setDescription($description);
  
    // Run request
    $parent = $dlp->projectName($callingProjectId);
    $dlp->createInspectTemplate($parent, [
        'inspectTemplate' => $inspectTemplate,
        'templateId' => $templateId
    ]);

    // Print results
    print_r(
        'Successfully created template projects/' .
        $callingProjectId .
        '/inspectTemplates/' .
        $templateId .
        PHP_EOL
    );
}
// [END dlp_create_inspect_template]