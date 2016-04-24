<?php
namespace Paybox\Exception\Error;

use Paybox\Exception\Base as BaseException;

/**
 * Base error exception.
 */
abstract class Base extends BaseException
{
    /**
     * Mappung for error codes.
     *
     * @var array
     */
    protected static $codeMapping = [
        130  => 'ActionDisabled',
        110  => 'ActionOrContractMissing',
        600  => 'GeneralError',
        700  => 'IncorrectCustomerData',
        101  => 'IncorrectMerchantId',
        701  => 'IncorrectPhoneNumber',
        100  => 'IncorrectSignature',
        1000 => 'InternalError',
        711  => 'InvalidPhoneNumber',
        200  => 'MissingOrIncorrectParameter',
        400  => 'PaymentCanceled',
        420  => 'PaymentLimitExceeded',
        490  => 'PaymentNotCancelable',
        350  => 'TransactionLocked',
        340  => 'TransactionNotFound',
        360  => 'TransactionOutdated',
    ];

    /**
     * Factory method.
     *
     * @param integer $errorCode
     */
    public static function factory($errorCode)
    {
        $className = sprintf('\\Paybox\\Exception\\Error\\%s', isset(self::$codeMapping[$errorCode])
            ? self::$codeMapping[$errorCode]
            : 'UnknownCode');

        return new $className();
    }
}
