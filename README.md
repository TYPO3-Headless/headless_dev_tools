# Headless dev tools - helpful code for local development

Extension provides small tweaks/utilities to help develop TYPO3 in headless way on local environment.

## Installation
Install extension using composer

``composer require --dev friendsoftypo3/headless-dev-tools``

**DO NOT USE IN PRODUCTION** always install as require-dev only

## Admin Panel

This extension provides a replacement for EXT:adminpanel's middleware to attach the adminpanel's HTML to the end of the rendered markup.

```
page.config.admPanel = 1
```

This renders the adminpanels HTML "as is" to the end of your JSON under the property key `admPanel`.

## ViewHelpers

### Debug ViewHelper

Just like `f:debug` but dies afterwards, so its output is actually visible in the frontend response.

```xml
<headlessDevTools:debug title="_all">{_all}</headlessDevTools:debug>
```
