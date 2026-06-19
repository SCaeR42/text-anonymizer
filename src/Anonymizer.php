<?php

namespace Scody\TextAnonymizer;

class Anonymizer
{
    /**
     * Mask email address, showing only first and last character of local part
     */
    public function maskEmail(string $email): string
    {
        $parts = explode('@', $email, 2);
        
        if (count($parts) !== 2) {
            return $email;
        }
        
        $localPart = $parts[0];
        $domain = $parts[1];
        
        if (strlen($localPart) <= 2) {
            return $email;
        }
        
        $firstChar = $localPart[0];
        $lastChar = $localPart[-1];
        $maskedMiddle = str_repeat('*', strlen($localPart) - 2);
        
        return $firstChar . $maskedMiddle . $lastChar . '@' . $domain;
    }

    /**
     * Mask phone number, showing only last 4 digits
     */
    public function maskPhone(string $phone): string
    {
        // Extract digits only
        $digits = preg_replace('/\D/', '', $phone);
        
        if (strlen($digits) < 4) {
            return $phone;
        }
        
        $visibleDigits = substr($digits, -4);
        $maskedCount = strlen($digits) - 4;
        
        return str_repeat('*', $maskedCount) . $visibleDigits;
    }

    /**
     * Mask credit card number, showing only last 4 digits
     */
    public function maskCard(string $card): string
    {
        // Extract digits only
        $digits = preg_replace('/\D/', '', $card);
        
        if (strlen($digits) < 4) {
            return $card;
        }
        
        $visibleDigits = substr($digits, -4);
        $maskedCount = strlen($digits) - 4;
        
        return str_repeat('*', $maskedCount) . $visibleDigits;
    }

    /**
     * Mask all sensitive data in text (emails, phones, cards)
     */
    public function maskAll(string $text): string
    {
        // Mask emails
        $text = preg_replace_callback(
            '/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/',
            fn($m) => $this->maskEmail($m[0]),
            $text
        );
        
        // Mask phone numbers (various formats)
        $text = preg_replace_callback(
            '/(\+?\d{1,3}[-.\s]?)?\(?\d{3}\)?[-.\s]?\d{3}[-.\s]?\d{4}/',
            fn($m) => $this->maskPhone($m[0]),
            $text
        );
        
        // Mask card numbers (13-19 digits)
        $text = preg_replace_callback(
            '/\b\d{13,19}\b/',
            fn($m) => $this->maskCard($m[0]),
            $text
        );
        
        return $text;
    }
}