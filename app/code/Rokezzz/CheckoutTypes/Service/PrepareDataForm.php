<?php
declare(strict_types=1);

namespace Rokezzz\CheckoutTypes\Service;

class PrepareDataForm
{
    /**
     * @param array $array
     * @return array
     */
    public static function arrayFlatten(array $array): array
    {
        $return = [];
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $return = array_merge($return, self::arrayFlatten($value));
            } else {
                $return[$key] = $value;
            }
        }

        return $return;
    }
}
