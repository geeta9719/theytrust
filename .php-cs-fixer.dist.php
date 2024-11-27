<?php

return (new PhpCsFixer\Config())
    ->setRiskyAllowed(true)
    ->setRules([
        // PSR-12 Coding Standards
        '@PSR12' => true,

        // Array Syntax: Use short array syntax `[]`
        'array_syntax' => ['syntax' => 'short'],

        // Remove unused `use` statements
        'no_unused_imports' => true,

        // Ensure there is no extra blank line
        'no_extra_blank_lines' => true,

        // Remove whitespace in blank lines
        'no_whitespace_in_blank_line' => true,

        // Ensure indentation is consistent (4 spaces)
        'indentation_type' => true,

        // Add a space after function arguments and commas
        'function_declaration' => ['closure_function_spacing' => 'one'],

        // No trailing whitespace
        'no_trailing_whitespace' => true,

        // Single space around operators
        'binary_operator_spaces' => [
            'default' => 'single_space',
        ],

        // Trailing comma in multiline arrays
        'trailing_comma_in_multiline' => ['elements' => ['arrays']],

        // Ensure proper spacing in control structures
        'control_structure_continuation_position' => ['position' => 'next_line'],
    ])
    ->setFinder(
        PhpCsFixer\Finder::create()
            ->in(__DIR__)
            ->exclude('vendor') // Exclude vendor directory
            ->exclude('node_modules') // Exclude node_modules directory
            ->name('*.php') // Only PHP files
    );
