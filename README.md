# pcon_configurator_url

This module adds a custom field on the product page in the backoffice.
Custom product-field for Prestashop 1.7 to specify a pCon.ui configurator.

## Current produt hooks

- displayAdminProductsMainStepLeftColumnBottom

## Requirements

- Prestashop >= 1.7.x
- composer >= 2.0.8
- See https://devdocs.prestashop.com/1.7/basics/installation/system-requirements/#php-compatibility-chart

## Install

- `cd` your_shop_root_dir/modules
- `git` clone https://github.com/sebastian-marinescu/pcon_configurator_url.git
- `cd` pcon_configurator_url
- `composer` install
- Go to BO > Improvement > Modules catalog and install

## Usage

### Access your data in the Frontend

```{$product.pcon_configurator_url.pcon_configurator_url_field}```
