<?php

namespace Omarpre\IdleTimeoutAlert\TimeoutCalculator;

class FileSessionChecker extends SessionChecker
{
    public function getLastModified()
    {
        $session_explode = explode('|',$this->sessionId);
        foreach($session_explode as $v){
            $sessionFile = storage_path("framework/sessions/$v");
            if (file_exists($sessionFile)) {
                break;
            }
        }
	if (!file_exists($sessionFile)) {
            throw new TimeoutCalculatorException('Session not found');
        }

        return filemtime($sessionFile);
    }
}
