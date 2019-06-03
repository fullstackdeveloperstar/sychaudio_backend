<?php

class AUTHORIZATION
{
    public static function validateTimestamp($token)
    {
        $CI =& get_instance();
        $token = self::validateToken($token);
        if ($token != false && (now() - $token->timestamp < ($CI->config->item('token_timeout') * 60))) {
            return $token;
        }
        return false;
    }

    public static function validateToken($token)
    {
        $CI =& get_instance();
        return JWT::decode($token, $CI->config->item('jwt_key'));
    }

    public static function generateToken($data)
    {
        $CI =& get_instance();
        return JWT::encode($data, $CI->config->item('jwt_key'));
    }

    public static function checkAuth()
    {
        $CI = & get_instance();
        $headers = $CI->input->request_headers();
        
        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = JWT::decode($headers['Authorization'], $CI->config->item('jwt_key'));
            if ($decodedToken != false) {
                return true;
            } else {
                return false;
            }
        }

        return false;
    }

    public static function checkAdminAuth()
    {
        $CI = & get_instance();
        $headers = $CI->input->request_headers();
        
        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = JWT::decode($headers['Authorization'], $CI->config->item('jwt_key'));
            if ($decodedToken != false) {
                if($decodedToken->user_role == '0') {
                    return true;
                } else {
                    return false;
                }
                
            } else {
                return false;
            }
        }

        return false;
    }

}