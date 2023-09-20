<?php
class UserManagement {
    private $maxLoginAttempts = 3; // מספר הנסיונות המרבי לכניסה
    private $lockoutTime = 60; // זמן נעילה לאחר הגעת למספר הנסיונות המרבי
    private $lockoutFile = 'lockout.txt'; // קובץ לאחסון הנסיונות

    public function authenticate($password) {
        if ($this->isLockedOut()) {
            echo "נעולה מפני ניסיונות רבים לכניסה. נסה שוב מאוחר יותר.";
            return false;
        }

        if ($password === "AAA") {
            $_SESSION['authenticated'] = true;
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
            $this->resetLoginAttempts();
            return true;
        } else {
            $this->increaseLoginAttempts();
            echo "סיסמה שגויה! נותרו " . $this->getRemainingAttempts() . " נסיונות.";
            return false;
        }
    }

    private function increaseLoginAttempts() {
        $attempts = $this->getLoginAttempts();
        $attempts++;
        file_put_contents($this->lockoutFile, $attempts);
    }

    private function resetLoginAttempts() {
        file_put_contents($this->lockoutFile, '0');
    }

    private function getLoginAttempts() {
        if (file_exists($this->lockoutFile)) {
            return (int) file_get_contents($this->lockoutFile);
        }
        return 0;
    }

    private function isLockedOut() {
        $attempts = $this->getLoginAttempts();
        if ($attempts >= $this->maxLoginAttempts) {
            $lockoutTime = filemtime($this->lockoutFile) + ($this->lockoutTime * 60);
            if (time() < $lockoutTime) {
                return true;
            }
        }
        return false;
    }

    private function getRemainingAttempts() {
        return $this->maxLoginAttempts - $this->getLoginAttempts();
    }
}
?>
