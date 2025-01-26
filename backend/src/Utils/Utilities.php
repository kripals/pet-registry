<?php
namespace App\Utils;

class Utilities
{
    /**
     * Convert a duration string to years.
     *
     * @param string $duration
     * @return float
     */
    public static function convertDurationToYears(string $duration): float
    {
        // Define the number of days in a year and a month
        $daysInYear = 365;
        $daysInMonth = 30;

        // Initialize total days
        $totalDays = 0;

        // Use a regular expression to extract the numbers and units
        preg_match_all('/(\d+)\s*(years?|months?|days?)/i', $duration, $matches, PREG_SET_ORDER);

        // Loop through the matches and calculate the total days
        foreach ($matches as $match) {
            $value = (int)$match[1];
            $unit = strtolower($match[2]);

            switch ($unit) {
                case 'year':
                case 'years':
                    $totalDays += $value * $daysInYear;
                    break;
                case 'month':
                case 'months':
                    $totalDays += $value * $daysInMonth;
                    break;
                case 'day':
                case 'days':
                    $totalDays += $value;
                    break;
            }
        }

        // Convert total days to years
        $totalYears = $totalDays / $daysInYear;

        return $totalYears;
    }
}