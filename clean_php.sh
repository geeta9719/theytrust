#!/bin/bash

echo "Cleaning PHP files..."

find ./ -name "*.php" | while read file; do
    echo "Processing $file"
    php -l "$file" > /dev/null
    if [ $? -eq 0 ]; then
        sed -i 's/[ \t]*$//' "$file" # Remove trailing spaces
    else
        echo "Syntax error in $file. Skipping..."
    fi
done

echo "All PHP files cleaned!"
