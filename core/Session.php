<?php


namespace app\core;


class Session
{
    protected const FLASH_KEY = 'flash_messages';
    
    public function __construct()
    {
        session_start();
        
        $allFlashMessages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach ($allFlashMessages as $key => &$flashMessage) {
            $flashMessage['toRemove'] = true;
        }

        $_SESSION[self::FLASH_KEY] = $allFlashMessages;
    }

    public function setFlash($key, $message)
    {
        $_SESSION[self::FLASH_KEY][$key] = [
            'toRemove' => false,
            'value' => $message
        ];
    }

    public function getFlash($key)
    {
        return $_SESSION[self::FLASH_KEY][$key]['value'] ?? false;
    }

    public function __destruct()
    {
        // Remove marked flash messages
        $allFlashMessages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach ($allFlashMessages as $key => &$flashMessage) {
            if ($flashMessage['toRemove']){
                unset($allFlashMessages[$key]);
            }
        }

        $_SESSION[self::FLASH_KEY] = $allFlashMessages;
    }
}