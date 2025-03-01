#!/bin/sh
if [ -f package.json ]; then
  npm install
fi
exec npm run dev -- --host
