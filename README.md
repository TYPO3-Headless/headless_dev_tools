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
<html xmlns="http://www.w3.org/1999/xhtml" lang="en"
    xmlns:f="http://typo3.org/ns/TYPO3/Fluid/ViewHelpers"
    xmlns:hdt="http://typo3.org/ns/FriendsOfTYPO3/HeadlessDevTools/ViewHelpers"
    data-namespace-typo3-fluid="true"
>

<hdt:debug title="_all">{_all}</hdt:debug>
```
