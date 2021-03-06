#
# This file is part of eastoriented/library.
#
# For the sake of mankind, DO NOT MODIFY IT!
#
# Have a good day!
#
#
# Disable builtin rules and variables, because they are useless in our context and add lot of noise when `make -d` is used to debug the macfly.
MAKEFLAGS+= --no-builtin-rules
MAKEFLAGS+= --no-builtin-variables

.DEFAULT_GOAL:=help

ifeq "$(firstword $(MAKECMDGOALS))" "verbose"

.PHONY: verbose
verbose: ## <Debug> Display all executed commands during targets building
	$(MAKE) $(filter-out verbose,$(MAKECMDGOALS)) WITH_DEBUG=TRUE

else

include .do_not_touch/config.mk

THIS_DIR:=$(dir $(abspath $(lastword $(MAKEFILE_LIST))))
THIS_MAKEFILE=$(word $(words $(MAKEFILE_LIST)),$(MAKEFILE_LIST))
RESOURCES_DIR:=$(THIS_DIR)/resources
MKDIR:=mkdir -p
RM:=rm -rf
MV:=mv -f
DOCKER_COMPOSE:=$(shell which docker-compose || echo 'bin/docker-compose')
CURRENT_VERSION:=$(shell git describe --tags --abbrev=0 2>/dev/null || echo 0.0.0)
INSTALLED_PHP_VERSION:=$(shell grep -e "^\s\+php-\([^:]\+\)" docker-compose.yml docker-compose.override.yml 2>/dev/null | cut -d: -f2 | cut -d- -f2 | sort | uniq || true)

ifneq ($(WITH_DEBUG),)
OLD_SHELL := $(SHELL)
SHELL = $(warning $(if $@, Update target $@)$(if $<, from $<)$(if $?, due to $?))$(OLD_SHELL) -x
endif

define locate
$(or $(shell which $1),$(error \`$1\` is not in \`$(PATH)\`, please install it!))
endef

define binary
$(RM) $1
$(call write,$1,'#!/usr/bin/env sh')
$(call write,$1,'set -e')
$(call write,$1,'exec $(DOCKER_COMPOSE) run --rm $2 $3 "$$@" 2>/dev/null')
chmod u+x $1
endef

define semver
git tag $$($(DOCKER_COMPOSE) run --rm semver semver -c -i $1 $$(git describe --tags --abbrev=0 2>/dev/null || echo 0.0.0))
endef

define write
echo $2 >> $1
endef

define switch-php
cat .env | grep -v PHP_VERSION | tee .env > /dev/null
$(call write,.env,"PHP_VERSION=$1");
bin/composer install
endef

.SILENT:

.SUFFIXES:

.DELETE_ON_ERROR:

.PRECIOUS: %/.

%/.:
	$(MKDIR) $@

install: $(call locate,docker) bin/php bin/composer ## <Install> Install development environment

.env:
	$(call write,$@,"HOME=$(HOME)")
	$(call write,$@,"USER_ID=$$(id -u):$$(id -g)")

bin/php: $(THIS_MAKEFILE) | docker-compose.yml bin/. $(DOCKER_COMPOSE) ## <Binaries> Create wrapper for `php` using `docker`
	$(call binary,$@,php,php)

bin/atoum: $(THIS_MAKEFILE) | docker-compose.yml bin/. .atoum.php vendor $(DOCKER_COMPOSE) ## <Binaries> Create wrapper for `atoum` using `docker`
	$(call binary,$@,php,/src/vendor/$@)

bin/composer: $(THIS_MAKEFILE) | docker-compose.yml bin/. .env $(DOCKER_COMPOSE) ## <Binaries> Create wrapper for `composer` using `docker`
	$(call binary,$@,composer,composer)

bin/docker-compose: DOCKER_COMPOSE_VERSION=$(shell curl --silent "https://api.github.com/repos/docker/compose/releases/latest" | grep '"tag_name":' |  sed -E 's/.*"([^"]+)".*/\1/')
bin/docker-compose: | $(call locate,curl) bin/. .env docker-compose.yml  ## <Binaries> Create wrapper for `docker-compose` using `docker`
	curl -L --fail https://github.com/docker/compose/releases/download/$(DOCKER_COMPOSE_VERSION)/run.sh -o $@
	chmod u+x $@

vendor: vendor/autoload.php  ## <Install> Create or recreate `vendor` directory

vendor/autoload.php: composer.lock | bin/composer
	bin/composer install

vendor/update: | bin/composer ## <Update> Update `vendor` directory
	bin/composer update
	./vendor/bin/eastoriented-library install

.PHONY: autoload
autoload: composer.json | bin/composer ## <Update> Generate autoload files
	bin/composer dump-autoload

.PHONY: tests/units
tests/units: | bin/php tests/units/runner.php vendor ## <Quality> Run unit tests
	bin/php tests/units/runner.php

.PHONY: version/new/major
version/new/major: | $(DOCKER_COMPOSE) ## <Versioning> Create tag for new major version
	$(call semver,major)

.PHONY: version/new/minor
version/new/minor: | $(DOCKER_COMPOSE) ## <Versioning> Create tag for new minor version
	$(call semver,minor)

.PHONY: version/new/patch
version/new/patch: | $(DOCKER_COMPOSE) ## <Versioning> Create tag for new patch version
	$(call semver,patch)

.PHONY: php/%
php/%: | bin/composer ## <Environment> Switch PHP version, for example `make php/7.2`
	@: $(if $(findstring $*,$(INSTALLED_PHP_VERSION)),,$(error PHP version $* is invalid, valid versions are $(INSTALLED_PHP_VERSION)))
	$(call switch-php,$*)

.PHONY: php/versions
php/versions: ## <Environment> Display all available PHP versions
	echo "Available PHP versions are $(INSTALLED_PHP_VERSION)"

.PHONY: help
help: ## <Help> Display this help.
	sed -e '/#\{2\} /!d; s/:[^#]*##/:/; s/\([^:]*\): <\([^>]*\)> \(.*\)/\2:\1:\3/; s/\([^:]*\): \([^<]*.*\)/Misc.:\1:\2/' $(MAKEFILE_LIST) | \
	sort -t: -d | \
	awk 'BEGIN{FS=":"; section=""} { if ($$1 != section) { section=$$1; printf "\n\033[1m%s\033[0m\n", $$1 } printf "\t\033[92m%s\033[0m:%s\n", $$2, $$3 }' | \
	column -c2 -t -s :

.PHONY: verbose
verbose:
	$(error Verbose syntax is `make verbose <target>`, not `make <target> verbose`)
endif
