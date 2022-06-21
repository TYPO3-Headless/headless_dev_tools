# Headless dev tools - helpful code for local development

Extension provides small tweaks/utilities to help develop TYPO3 in headless way on local environment.

## Installation
Install extension using composer

``composer require --dev friendsoftypo3/headless-dev-tools``

**DO NOT USE IN PRODUCTION** always install as require-dev only

## ViewHelpers

### Debug ViewHelper

Just like `f:debug` but dies afterwards, so its output is actually visible in the frontend response.

```xml
<headlessDevTools:debug title="_all">{_all}</headlessDevTools:debug>
```
