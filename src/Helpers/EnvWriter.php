<?php
namespace EngrShishir\Contactform\Helpers;

class EnvWriter
{
    public static function setEnvValue($key, $value)
    {
        $path = base_path('.env');  // Get the path to the .env file

        // If the .env file exists, update the key-value pair
        if (file_exists($path)) {
            // Ensure the value is wrapped in quotes
            $value = addslashes($value); // No need for wrapping in quotes for .env format

            // Get the current contents of the file
            $contents = file_get_contents($path);

            // Check if the key is commented out (starts with a #) or exists already uncommented
            if (preg_match("/^#?{$key}=[^\n]*/m", $contents)) {
                // Uncomment the line by removing the '#' character at the beginning of the line
                $contents = preg_replace("/^#?{$key}=[^\n]*/m", "{$key}={$value}", $contents);
            } else {
                // If the key doesn't exist, append it to the file
                $contents .= "\n{$key}={$value}";
            }

            // Write the contents back to the .env file
            file_put_contents($path, $contents);
        }

        // Clean extra newlines in the .env file
        // self::cleanEnvFile($path);
    }

    public static function removeEnvValue($key)
    {
        $path = base_path('.env');  // Get the path to the .env file

        // If the .env file exists, remove the key-value pair
        if (file_exists($path)) {
            // Get the current contents of the file
            $contents = file_get_contents($path);

            // Remove the line containing the specified key
            $contents = preg_replace("/^{$key}=[^\n]*/m", '', $contents);

            // Write the modified contents back to the .env file
            file_put_contents($path, $contents);
        }

        // Clean extra newlines in the .env file
        // self::cleanEnvFile($path);
    }

    public static function cleanEnvFile($filePath)
    {
        // Check if the file exists
        if (!file_exists($filePath)) {
            return "File not found!";
        }

        // Read the contents of the .env file
        $content = file_get_contents($filePath);

        // Replace any sequence of more than two newlines with exactly two newlines
        $cleanedContent = preg_replace('/\n{3,}/', "\n\n", $content);

        // Write the cleaned content back to the .env file
        file_put_contents($filePath, $cleanedContent);

        return "Extra newlines removed successfully!";
    }

    public static function get_locale_array()
    {
        return [
            'en' => 'English',
            'en_GB' => 'English (UK)',
            'en_US' => 'English (US)',
            'es' => 'Spanish',
            'es_ES' => 'Spanish (Spain)',
            'es_MX' => 'Spanish (Mexico)',
            'fr' => 'French',
            'fr_FR' => 'French (France)',
            'de' => 'German',
            'de_DE' => 'German (Germany)',
            'it' => 'Italian',
            'it_IT' => 'Italian (Italy)',
            'pt' => 'Portuguese',
            'pt_PT' => 'Portuguese (Portugal)',
            'pt_BR' => 'Portuguese (Brazil)',
            'nl' => 'Dutch',
            'nl_NL' => 'Dutch (Netherlands)',
            'ru' => 'Russian',
            'ru_RU' => 'Russian (Russia)',
            'zh' => 'Chinese',
            'zh_CN' => 'Chinese (Simplified)',
            'zh_TW' => 'Chinese (Traditional)',
            'ja' => 'Japanese',
            'ja_JP' => 'Japanese (Japan)',
            'ko' => 'Korean',
            'ko_KR' => 'Korean (South Korea)',
            'ar' => 'Arabic',
            'ar_SA' => 'Arabic (Saudi Arabia)',
            'hi' => 'Hindi',
            'hi_IN' => 'Hindi (India)',
            'tr' => 'Turkish',
            'tr_TR' => 'Turkish (Turkey)',
            'pl' => 'Polish',
            'pl_PL' => 'Polish (Poland)',
            'sv' => 'Swedish',
            'sv_SE' => 'Swedish (Sweden)',
            'da' => 'Danish',
            'da_DK' => 'Danish (Denmark)',
            'no' => 'Norwegian',
            'no_NO' => 'Norwegian (Norway)',
            'fi' => 'Finnish',
            'fi_FI' => 'Finnish (Finland)',
            'cs' => 'Czech',
            'cs_CZ' => 'Czech (Czech Republic)',
            'sk' => 'Slovak',
            'sk_SK' => 'Slovak (Slovakia)',
            'el' => 'Greek',
            'el_GR' => 'Greek (Greece)',
        ];
    }
}
