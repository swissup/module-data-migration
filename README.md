# Data Migration for Swissup Labs modules

### Installation

```bash
cd <magento_root>
composer config repositories.swissup composer https://swissup.github.io/packages/
composer require swissup/data-migration
bin/magento module:enable Swissup_DataMigration
bin/magento setup:upgrade
```