#!/bin/bash

# Script để generate APP_KEY cho Railway deployment

echo "🔑 Generating Laravel APP_KEY..."
echo ""

# Check if php artisan exists
if [ ! -f "artisan" ]; then
    echo "❌ Error: artisan file not found. Are you in the Laravel project root?"
    exit 1
fi

# Generate key
KEY=$(php artisan key:generate --show)

echo "✅ Your APP_KEY is:"
echo ""
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "$KEY"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo ""
echo "📋 Copy this key and paste it into Railway Variables as APP_KEY"
echo ""
echo "Next steps:"
echo "1. Go to Railway dashboard"
echo "2. Click on your Laravel service"
echo "3. Go to Variables tab"
echo "4. Add/Update APP_KEY with the value above"
echo ""
