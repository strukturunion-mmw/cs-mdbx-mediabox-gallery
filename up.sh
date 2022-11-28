#!/bin/bash

# Copy .env files
./credentials_compress.sh
cp ./@secret_credentials/.env.sail.dev ./src/.env

cd ./src && /workspaces/cs-ri-prognose-planung-2023/src/vendor/bin/sail up
