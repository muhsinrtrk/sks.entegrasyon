<?php


namespace App\Library\Validation;


use App\Exception\ValidationException;

class Validation
{

    public static function isValid($value, $rules)
    {
        $ruleArr = explode('|', $rules);

        foreach ($ruleArr as $rule) {
            $param = false;

            if (preg_match("/(.*?)\[(.*)]/", $rule, $match)) {
                $rule = $match[1];
                $param = $match[2];
            }

            if ($param !== false) {
                $res = self::{$rule}($value, $param);
            } else {
                $res = self::{$rule}($value);
            }

            if (!$res) {
                throw new ValidationException('Entity '.$value.' is not valid. Rule: '.$rule);
            }
        }
    }


    /**
     * @param $str
     * @return bool
     */
    public static function required($str): bool
    {
        if (!is_array($str)) {
            return !((trim($str) == ''));
        } else {
            return (!empty($str));
        }
    }

    /**
     * @param $str
     * @param $val
     * @return bool
     */
    public static function min_length($str, $val): bool
    {
        if (preg_match("/[^0-9]/", $val)) {
            return FALSE;
        }

        return !((mb_strlen($str) < $val));
    }

    /**
     * Max Length
     * @param $str
     * @param $val
     * @return bool
     */
    public static function max_length($str, $val): bool
    {
        if (preg_match("/[^0-9]/", $val)) {
            return FALSE;
        }

        return !((mb_strlen($str) > $val));
    }

    /**
     * Exact Length
     * @param $str
     * @param $val
     * @return bool
     */
    public static function exact_length($str, $val): bool
    {
        if (preg_match("/[^0-9]/", $val)) {
            return FALSE;
        }

        if (function_exists('mb_strlen')) {
            return !((mb_strlen($str) != $val));
        }

        return !((strlen($str) != $val));
    }

    /**
     * Valid domain
     * @access    public
     * @param string
     * @return    bool
     */
    public static function valid_domain($domain_name): bool
    {
        return (bool)(preg_match("/^(?:[-A-Za-z0-9]+\.)+[A-Za-z]{2,6}$/i", $domain_name)); //length of each label
    }

    /**
     * @param $str
     * @return bool
     */
    public static function alpha($str): bool
    {
        return !!preg_match("/^([a-z])+$/i", $str);
    }

    /**
     * @param $str
     * @return bool
     */
    public static function alpha_numeric($str): bool
    {
        return !!preg_match("/^([a-z0-9])+$/i", $str);
    }

    /**
     *  Alpha-numeric with underscores and dashes
     * @param $str
     * @return bool
     */
    public static function alpha_dash($str): bool
    {
        return !!preg_match("/^([-a-z0-9_-])+$/i", $str);
    }

    /**
     * @param $str
     * @return bool
     */
    public static function numeric($str): bool
    {
        return (bool)preg_match('/^[\-+]?[0-9]*\.?[0-9]+$/', $str);
    }

    /**
     * @param $str
     * @return bool
     */
    public static function is_numeric($str): bool
    {
        return !(($str && !is_numeric($str)));
    }

    /**
     * @param $str
     * @return bool
     */
    public static function integer($str): bool
    {
        return (bool)preg_match('/^[\-+]?[0-9]+$/', $str);
    }

    /**
     * @param $str
     * @return bool
     */
    public static function decimal($str): bool
    {
        return (bool)preg_match('/^[\-+]?[0-9]+\.[0-9]+$/', $str);
    }

    /**
     * Type for files
     * @param $str
     * @param $types
     * @return bool
     */
    public static function valid_type($str, $types): bool
    {
        $types = explode('*', $types);
        $str = strtolower($str);

        return in_array($str, $types);
    }

    /**
     * Valid Base64
     * Tests a string for characters outside of the Base64 alphabet
     * as defined by RFC 2045 http://www.faqs.org/rfcs/rfc2045
     *
     * @param $str
     * @return bool
     */
    public static function valid_base64($str): bool
    {
        return !preg_match('/[^a-zA-Z0-9\/+=]/', $str);
    }

    /**
     *  Is a Natural number  (0,1,2,3, etc.)
     * @param $str
     * @return bool
     */
    public static function is_natural($str): bool
    {
        return (bool)preg_match('/^[0-9]+$/', $str);
    }

    /**
     * Is a Natural number, but not a zero  (1,2,3, etc.)
     * @param $str
     * @return bool
     */
    public static function is_natural_no_zero($str): bool
    {
        if (!preg_match('/^[0-9]+$/', $str)) {
            return FALSE;
        }

        if ($str == 0) {
            return FALSE;
        }

        return TRUE;
    }

    /**
     * @param $str
     * @param $min
     * @return bool
     */
    public static function greater_than($str, $min): bool
    {
        if (!is_numeric($str)) {
            return FALSE;
        }
        return $str > $min;
    }

    /**
     * @param $str
     * @param $max
     * @return bool
     */
    public static function less_than($str, $max): bool
    {
        if (!is_numeric($str)) {
            return FALSE;
        }
        return $str < $max;
    }

    /**
     * @param $str
     * @param $regex
     * @return bool
     */
    public static function regex_match($str, $regex): bool
    {
        if (!preg_match($regex, $str)) {
            return FALSE;
        }
        return TRUE;
    }

//    /**
//     * Match one field to another
//     * @param $str
//     * @param $field
//     * @return bool
//     */
//    public static function matches($str, $field): bool
//    {
//        if (!isset($_POST[$field])) {
//            return FALSE;
//        }
//
//        $field = $_POST[$field];
//
//        return !(($str !== $field));
//    }

    /**
     * Valid Emails
     *
     * @access    public
     * @param string
     * @return    bool
     */
    public static function valid_emails($str): bool
    {
        if (!str_contains($str, ',')) {
            return static::valid_email(trim($str));
        }

        foreach (explode(',', $str) as $email) {
            if (trim($email) != '' && static::valid_email(trim($email)) === FALSE) {
                return FALSE;
            }
        }

        return TRUE;
    }

    /**
     * Valid Email
     *
     * @access    public
     * @param string
     * @return    bool
     */
    public static function valid_email($str): bool
    {
        return (bool)filter_var(trim($str), FILTER_VALIDATE_EMAIL);
    }

    /**
     * @param $str
     * @return bool
     */
    public static function valid_ips($str): bool
    {
        if ($str) {
            if (!str_contains($str, ',')) {
                return static::valid_ip(trim($str));
            }

            foreach (explode(',', $str) as $ip) {
                if (trim($ip) != '' && static::valid_ip(trim($ip)) === FALSE) {
                    return FALSE;
                }
            }
        }
        return TRUE;
    }

    /**
     * Validate IP Address
     * @param $str
     * @return bool
     */
    public static function valid_ip($str): bool
    {
        return (bool)filter_var($str, FILTER_VALIDATE_IP);
    }


//    /**
//     * valid_phone
//     *
//     *
//     * @access	public
//     * @param	string
//     * @return	bool
//     */
//    public static function valid_phone($str) {
//
//        try {
//            include_once ROOT_PATH . '/System/Helper/PhoneValidation/vendor/autoload.php';
//            $phoneUtil = \libphonenumber\PhoneNumberUtil::getInstance();
//
////            pre($str,1);
//            $numberProto = $phoneUtil->parse($str, '');
//            $res = $phoneUtil->isValidNumber($numberProto);
//            return $res == true;
//        } catch (\Exception $e) {
////            pre($str,1);
//            return false;
//        }
//    }

    /**
     * @param string $str
     * @return string
     */
    public static function prep_url($str = '')
    {
        if ($str == 'http://' or $str == '') {
            return '';
        }

        if (substr($str, 0, 7) != 'http://' && substr($str, 0, 8) != 'https://') {
            $str = 'http://' . $str;
        }

        return $str;
    }

}