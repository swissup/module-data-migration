# Data Migration for Swissup Labs modules

### Installation

```bash
cd <magento_root>
composer config repositories.swissup composer https://docs.swissuplabs.com/packages/
composer require swissup/module-data-migration
bin/magento module:enable Swissup_DataMigration
bin/magento setup:upgrade
```
