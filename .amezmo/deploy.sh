#!/bin/bash
set -e

if command -v composer2 >/dev/null 2>&1; then
    composer2 install --no-ansi --no-progress --no-interaction --no-dev
else
    composer install --no-ansi --no-progress --no-interaction --no-dev
fi
