<?php 

// app/Support/Helpers.php

use App\Models\Prospect;

if (! function_exists('replace_placeholders')) {
    function replace_placeholders(?string $text, Prospect $prospect): string
    {
        if (empty($text)) return '';

        $replacements = [
            '{$first_name}' => $prospect->first_name,
            '{${first_name}}' => $prospect->first_name,
            '{$last_name}' => $prospect->last_name,
            '{${last_name}}' => $prospect->last_name,
            '{$second_last_name}' => $prospect->second_last_name,
            '{${second_last_name}}' => $prospect->second_last_name,
            '{$email}' => $prospect->email,
            '{${email}}' => $prospect->email,
            '{$phone}' => $prospect->phone,
            '{${phone}}' => $prospect->phone,
            '{$company}' => $prospect->company,
            '{${company}}' => $prospect->company,
            '{$linkedin_url}' => $prospect->linkedin_url,
            '{${linkedin_url}}' => $prospect->linkedin_url,
            '{$location.name}' => $prospect->location->name ?? '',
            '{${location.name}}' => $prospect->location->name ?? '',
        ];

        return str_replace(array_keys($replacements), array_values($replacements), $text);
    }
}
