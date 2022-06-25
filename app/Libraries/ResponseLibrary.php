<?php

namespace App\Libraries;

use App\Constants\ResponseConstants;

class ResponseLibrary extends ResponseConstants
{
    public static function successResponse($sMessage, $aData = [])
    {
        return response()->json([
            self::RESULT  => self::SUCCESS,
            self::MESSAGE => $sMessage,
            self::DATA    => $aData,
        ], );
    }

    public static function errorResponse($sMessage, $iHttpCode)
    {
        return response()->json([
            self::RESULT  => self::FAIL,
            self::MESSAGE => $sMessage,
        ], $iHttpCode);
    }

    public static function badParametersResponse()
    {
        return self::errorResponse(ResponseConstants::BAD_REQUEST_PARAMETERS, ResponseConstants::BAD_REQUEST_ERROR_CODE);
    }
}
