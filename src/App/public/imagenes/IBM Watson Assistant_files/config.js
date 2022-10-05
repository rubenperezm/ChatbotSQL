/**
 *
 * IBM Confidential
 *
 * (C) Copyright IBM Corp. 2019
 *
 * The source code for this program is not published or otherwise
 * divested of its trade secrets, irrespective of what has been
 * deposited with the U. S. Copyright Office
 *
 * US Government Users Restricted Rights - Use, duplication or
 * disclosure restricted by GSA ADP Schedule Contract with IBM Corp.
 *
 **/

'use strict';

(function () {

  window.__webpack_public_path__ = '/';

  var conversation = window.conversation = {};

  conversation.config = {
    endpoints : {
      
      authenticate : '/rest/authenticate',
      bluemix : '/rest/bluemix',
      content : '/rest/content',
      store : '/rest',
      beta : '/rest/beta',
      betaAboutURL : "https://www.ibm.com/developerworks/learn/cognitive/index.html",
      betaStoreURL : "https://origin-gateway-lon.watsonplatform.net/assistant/api/v1"
    },
    hosts : {"standard":"assistant-eu-gb.watsonplatform.net","free":"assistant-eu-gb.watsonplatform.net","premium":"assistant-eu-gb.watsonplatform.net"},
    regions : {"eu-gb":{"console":"https://cloud.ibm.com","api":"https://api.eu-gb.bluemix.net","bss":"https://accountmanagement.eu-gb.bluemix.net","mccp":"https://mccp.eu-gb.bluemix.net"}},
    features : {"analytics":true,"channels":true,"overview":true,"tryit-context":true,"frames":true,"condition-builder":true,"slot-builder":true,"simplified-dialog":true,"slots-video":true,"mcr2":true,"dnr":true,"slot-condition":true,"slackapp":true,"fbapp":true,"mirroring":true,"simple-context-editor":true,"copy-node":true,"hard-logout":false,"folders":true,"folder-conditions":true,"new-workspaces":false,"mcr-jump-to":true,"synonym-recommendations":true,"beta-access-button":false,"catalog":true,"integrations":true,"intercom-chat":false,"dialog-search":true,"node-tracing":true,"response-types":true,"open-entities":true,"disambiguation":true,"enable-premium-features":false,"beta":false,"icp":false,"search-skill":true,"assistant-skills":true,"callouts":false,"autolearn":false,"react-search":true,"credentials":true,"recommendations":false,"export-delete":true,"pattern-entities":true,"new-intents":false,"new-entities":true,"deployment-ids":true,"search":true,"search-show-more":true,"new-analytics-layout":true,"intent-conflicts":true,"intent-recommendations":true,"react-catalog":true,"react-intent-conflicts":true,"skill-versions":true,"intercom-integration":true,"clusters":true,"spell-check":true,"dialog-skill-options":true,"system-entities-v2":true},
    languages : [{"value":"ar","label":"ARABIC","off-topic":"2017-04-21","fuzzy-match":true,"search":false},{"value":"de","label":"GERMAN","off-topic":"2017-04-21","fuzzy-match":true,"search":true,"system-entities-v2":true},{"value":"en","label":"ENGLISH_US","off-topic":"2017-02-03","fuzzy-match":true,"search":true,"synonym-recommendations":true,"open-entities":true,"intent-recommendations":true,"spell-check":true,"system-entities-v2":true},{"value":"es","label":"SPANISH","off-topic":"2017-04-21","fuzzy-match":true,"search":true,"synonym-recommendations":true},{"value":"fr","label":"FRENCH","off-topic":"2017-04-21","fuzzy-match":true,"search":true,"synonym-recommendations":true},{"value":"it","label":"ITALIAN","off-topic":"2017-04-21","fuzzy-match":true,"search":true},{"value":"ja","label":"JAPANESE","off-topic":"2017-04-21","fuzzy-match":true,"search":true,"synonym-recommendations":true,"intent-recommendations":true},{"value":"ko","label":"KOREAN","off-topic":"2017-04-21","fuzzy-match":true,"search":true},{"value":"pt-br","label":"BRAZILIAN_PORTUGUESE","off-topic":"2017-04-21","fuzzy-match":true,"search":true},{"value":"cs","label":"CZECH","off-topic":"2017-04-21","fuzzy-match":true,"search":true},{"value":"nl","label":"DUTCH","off-topic":"2017-04-21","search":true},{"value":"zh-tw","label":"CHINESE_TRADITIONAL","experimental":true,"off-topic":"2017-04-21","search":true},{"value":"zh-cn","label":"CHINESE_SIMPLIFIED","off-topic":"2017-04-21","search":true}],
    analyticsId : '',
    segment : {"key":"XroYJWPOY9jAMsZSceoCmc6bWLd6Z7iD","src":"https://cloud.ibm.com/analytics/build/bluemix-analytics.min.js"},
    deployEnv : "lonprd",
    integrations : {"intercom":{"client_id":"fe417d6a-c124-4f3e-912f-8676c15e0e92","oauth_redirect_url":"https://assistant-eu-gb.watsonplatform.net"},"zendesk":{"client_id":"oCt0xPBLEfTmf4BbAMyflEtc6ltce5SwRZVO7ntq9k566tfx7H","oauth_redirect_url":"https://assistant-eu-gb.watsonplatform.net"}},
    buildInfo : {"imageTag":"ui:20190611-011423-54166e93","buildTime":"011423","buildDate":"20190611","gitCommit":"54166e93"}
  };

})();
