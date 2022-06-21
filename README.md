# pconconfiguratorurl

This module adds a custom product-field on the product page in the backoffice to specify a pCon.UI configurator URL.

## Current hook

- displayAdminProductsMainStepLeftColumnBottom

## Requirements

- Prestashop >= 1.7.x
- Composer >= 2.0.8
- PHP => See [PHP compatibility chart](https://devdocs.prestashop.com/1.7/basics/installation/system-requirements/#php-compatibility-chart)

## Installation

- `cd` your_shop_root_dir/modules
- `git` clone https://github.com/sebastian-marinescu/pconconfiguratorurl.git
- `cd` pconconfiguratorurl
- `composer` install
- Go to BO > Improvement > Modules-Catalog and install

## Usage

### Access your data in the Frontend

```{$product.pconconfiguratorurl.pconconfiguratorurl_field}```
